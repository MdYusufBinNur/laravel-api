<?php

namespace App\Repositories;

use App\DbModels\Attachment;
use App\DbModels\Manager;
use App\DbModels\Resident;
use App\DbModels\Role;
use App\DbModels\Unit;
use App\DbModels\UserRole;
use App\Events\User\UserCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        /*$cacheKey = 'findBy:user-search:' . json_encode($searchCriteria);
        if (($users = $this->getCacheByKey($cacheKey))) {
            return $users;
        }*/

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['user.roles' => 'userRoles', 'user.profilePic' => 'userProfilePics', 'user.userProfile' => 'userProfile', 'user.residents' => 'residents', 'user.staffs' => 'managers', 'user.enterpriseUser' => 'enterpriseUser', 'userRole.role' => 'userRoles.role', 'userRole.property' => 'userRoles.property', 'eu.properties' => 'enterpriseUser.enterpriseUserProperties'];

        $users = parent::findBy($searchCriteria, $withTrashed);

        //$this->setCacheByKey($cacheKey, $users);

        return $users;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id, $withTrashed = false): ?\ArrayAccess
    {
        if ($id === 'me') {
            return $this->getLoggedInUser();
        }

        return parent::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $user = parent::save($data);

        if (isset($data['role'])) {
            $data['role']['userId'] = $user->id;
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->save($data['role']);
        }

        event(new UserCreatedEvent($user, $this->generateEventOptionsForModel()));

        DB::commit();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function updateUser(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (!empty($data['notificationSeen'])) {
            $data['notificationSeenAt'] = Carbon::now();
            unset($data['notificationSeen']);
        }
        $user = parent::update($model, $data);


        $userRoleRepository = app(UserRoleRepository::class);

        if (array_key_exists('role', $data)) {

            if (isset($data['role']['oldRoleId'])) {
                $userRole = $userRoleRepository->findOneBy(['userId' => $user->id, 'roleId' => $data['role']['oldRoleId']]);
                if ($userRole instanceof UserRole) {
                    $userRoleRepository->update($userRole, $data['role']);
                } else {
                    throw new NotFoundHttpException();
                }
            } else {
                $data['role']['userId'] = $user->id;
                $userRoleRepository->patch($data['role'], $data['role']);
            }
        }

        DB::commit();

        return $user;
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model->where('email', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('name', 'like', '%' . $searchCriteria['query'] . '%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['roleId']) || isset($searchCriteria['propertyId'])) {
            $userRoleRepository = app(UserRoleRepository::class);
            $queryBuilder = $userRoleRepository->model->select('userId');

            if (isset($searchCriteria['roleId'])) {
                if (!is_array($searchCriteria['roleId'])) {
                    $searchCriteria['roleId'] = [$searchCriteria['roleId']];
                }
                $queryBuilder = $queryBuilder->whereIn('roleId', $searchCriteria['roleId']);
            }

            if (isset($searchCriteria['propertyId'])) {
                $queryBuilder = $queryBuilder->where('propertyId', $searchCriteria['propertyId']);
            }

            $userIds = $queryBuilder->pluck('userId')->toArray();
            if (isset($searchCriteria['id'])) {
                if (is_array($searchCriteria['id'])) {
                    $searchCriteria['id'] = array_intersect($searchCriteria['id'], $userIds);
                } else {
                    $searchCriteria['id'] = array_intersect(explode(',', $searchCriteria['id']), $userIds);
                }
            } else {
                $searchCriteria['id'] = $userIds;
            }

            unset($searchCriteria['roleId']);
            unset($searchCriteria['propertyId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = is_array($searchCriteria['id']) ? implode(",", array_unique($searchCriteria['id'])) : $searchCriteria['id'];
        }

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function findStaffs(array $searchCriteria = [])
    {
        if (!isset($searchCriteria['roleId'])) {
            $searchCriteria['roleId'] = [Role::ROLE_STAFF_PRIORITY['id'], Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id']];
        }

        return $this->findBy($searchCriteria);
    }


    /**
     * @inheritDoc
     * todo
     */
    public function usersListAutoComplete(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $residentTable = Resident::getTableName();
        $unitTable = Unit::getTableName();
        $managerTable = Manager::getTableName();

        // don't return staffs if it asks for residents-only
        if (empty($searchCriteria['residentsOnly'])) {
            $staffsQueryBuilder = $this->model
                ->select($thisModelTable . '.id',
                    $thisModelTable . '.name',
                    $thisModelTable . '.email',
                    $thisModelTable . '.phone',
                    $managerTable . '.id as managerId',
                    $managerTable . '.title as managerTitle',
                    $managerTable . '.level as managerLevel'
                )
                ->join($managerTable, $thisModelTable . '.id', '=', $managerTable . '.userId')
                ->where($managerTable . '.propertyId', $searchCriteria['propertyId'])
                ->whereNull($managerTable . '.deleted_at');

            if (isset($searchCriteria['userId'])) {
                $searchCriteria['userId'] = explode(',', $searchCriteria['userId']);
                $staffsQueryBuilder->whereIn($thisModelTable . '.id', $searchCriteria['userId']);
            }

            if (isset($searchCriteria['query'])) {
                $staffsQueryBuilder->where($thisModelTable . '.name', 'like', '%' . $searchCriteria['query'] . '%');
            }

            $users = $staffsQueryBuilder
                ->with('userProfilePics')
                ->get();
        }

        // don't return residents if it asks for staffs-only
        if (empty($searchCriteria['staffsOnly'])) {
            $residentQueryBuilder = $this->model
                ->select($thisModelTable . '.id',
                    $thisModelTable . '.name',
                    $thisModelTable . '.email',
                    $thisModelTable . '.phone',
                    $residentTable . '.id as residentId',
                    $residentTable . '.type as residentTitle',
                    $unitTable . '.title as unit'
                )
                ->join($residentTable, $thisModelTable . '.id', '=', $residentTable . '.userId')
                ->join($unitTable, $unitTable . '.id', '=', $residentTable . '.unitId')
                ->where($residentTable . '.propertyId', $searchCriteria['propertyId'])
                ->whereNull($residentTable . '.deleted_at');

            if (isset($searchCriteria['userId'])) {

                if (is_string($searchCriteria['userId'])) {
                    $searchCriteria['userId'] = explode(',', $searchCriteria['userId']);
                }

                $residentQueryBuilder->whereIn($thisModelTable . '.id', $searchCriteria['userId']);
            }

            if (isset($searchCriteria['query'])) {
                $residentQueryBuilder->where($thisModelTable . '.name', 'like', '%' . $searchCriteria['query'] . '%');
            }

            $residents = $residentQueryBuilder
                ->with('userProfilePics')
                ->get();

            if (isset($users)) {
                $users = $users->merge($residents);
            } else {
                $users = $residents;
            }
        }

        return $users;
    }

    /**
     * @inheritDoc
     */
    public function findUserByEmailPhone($emailOrPhone)
    {
        return $this->model->where(['email' => $emailOrPhone])
            ->orWhere(['phone' => $emailOrPhone])
            ->first();
    }


    /**
     * @inheritDoc
     */
    public function getProfilePicByUserId($userId, $size = 'medium')
    {
        $attachmentRepository = app(AttachmentRepository::class);
        $profileAttachment = $attachmentRepository->getProfilePicByResourceId($userId, $size);

        return $profileAttachment;
    }

    /**
     * Get the users based on roleIds of a Property
     *
     * @param int $propertyId
     * @param array $roleIds
     * @return mixed
     */
    public function getUsersByRoleIdsInAProperty(int $propertyId, array $roleIds)
    {
        $thisModelTable = $this->model->getTable();
        $userRoleTable = UserRole::getTableName();

        $users = $this->model
            ->select($thisModelTable . '.*')
            ->join($userRoleTable, $thisModelTable . '.id', '=', $userRoleTable . '.userId')
            ->where($userRoleTable . '.propertyId', $propertyId)
            ->whereIn($userRoleTable . '.roleId', $roleIds)
            ->get();

        return $users;
    }

}
