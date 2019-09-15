<?php

namespace App\Repositories;

use App\DbModels\Role;
use App\DbModels\UserRole;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        $cacheKey = 'findBy:user-search:' . json_encode($searchCriteria);
        if (($user = $this->getCacheByKey($cacheKey))) {
            return $user;
        }

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['userRoles', 'userProfilePic'];

        $users =  parent::findBy($searchCriteria, $withTrashed);

        $this->setCacheByKey($cacheKey, $users);

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

        DB::commit();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRoleRepository = app(UserRoleRepository::class);

        $user = parent::update($model, $data);

        if(array_key_exists('role', $data)) {

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
            $searchCriteria['id'] = $this->model->where('email', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('name', 'like', '%'.$searchCriteria['query'].'%')
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
            $searchCriteria['id'] = isset($searchCriteria['id']) ? array_intersect($searchCriteria['id'], $userIds) : $userIds;
            unset($searchCriteria['roleId']);
            unset($searchCriteria['propertyId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

    /**
     * find staffs
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findStaffs(array $searchCriteria = [])
    {
        if (!isset($searchCriteria['roleId'])) {
            $searchCriteria['roleId'] = [Role::ROLE_STAFF_PRIORITY['id'], Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id']];
        }

        return $this->findBy($searchCriteria);
    }
}
