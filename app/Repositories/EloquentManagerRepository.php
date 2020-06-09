<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\DbModels\UserRole;
use App\Events\Manager\ManagerCreatedEvent;
use App\Services\Helpers\RoleHelper;
use App\Repositories\Contracts\ManagerRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentManagerRepository extends EloquentBaseRepository implements ManagerRepository
{
    /**
     * @inheritDoc
     */
    public function findStaffUsers(array $searchCriteria)
    {
        $userRoleTable = UserRole::getTableName();
        $thisTable = $this->model->getTable();

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 50; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $thisTable . '.' . $searchCriteria['order_by'] : $thisTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';

        $queryBuilder = $this->model
            ->join($userRoleTable, $thisTable . '.userId', '=', $userRoleTable . '.userId');

        if (isset($searchCriteria['propertyId'])) {
            $queryBuilder->where($thisTable . '.propertyId', $searchCriteria['propertyId']);
        }
        if (isset($searchCriteria['query'])) {
            $queryBuilder->where($thisTable . '.contactEmail', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere($thisTable . '.title', 'like', '%' . $searchCriteria['query'] . '%');
        }

        if (isset($searchCriteria['roleId'])) {
            $queryBuilder->whereIn($userRoleTable . '.roleId', [$searchCriteria['roleId']]);
        } else {
            $queryBuilder->whereIn($userRoleTable . '.roleId', [Role::ROLE_STAFF_PRIORITY['id'], Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id']]);
        }

        return $queryBuilder->select('managers.*')
            ->orderBy($orderBy, $orderDirection)
            ->with(['user', 'userRoles'])
            ->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRepository = app(UserRepository::class);
        if (isset($data['user'])) {
            $user = $userRepository->save($data['user']);
            $data['userId'] = $user->id;
        }

        if (array_key_exists('level', $data)) {
            if ($this->getLoggedInUser()->isAStandardStaffOfTheProperty($data['propertyId'])) {
                $roleId = Role::ROLE_STAFF_LIMITED['id'];
            } else {
                $roleId = RoleHelper::getRoleIdByTitle($data['level']);
            }
        } else {
            $roleId = Role::ROLE_STAFF_STANDARD['id'];
        }

        //create user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => $roleId, 'propertyId' => $data['propertyId'], 'userId' => $data['userId']]);

        $data['userRoleId'] = $userRole->id;
        $data['level'] = RoleHelper::getRoleTitleById($roleId);
        $manager = parent::save($data);

        // fire ManagerCreatedEvent
        event(new ManagerCreatedEvent($manager, $data));

        DB::commit();


        return $manager;

    }

    /**
     * @inheritDoc
     */
    public function updateManager(\ArrayAccess $manager, array $data): \ArrayAccess
    {
       // DB::beginTransaction();

        $staff = parent::update($manager, $data);
        $userRepository = app(UserRepository::class);

        if (isset($data['user'])) {
            $userRepository->updateUser($staff->user, $data['user']);
        }

        if (array_key_exists('level', $data)) {

            if ($this->getLoggedInUser()->isAStandardStaffOfTheProperty($staff->propertyId)) {
                $roleId = Role::ROLE_STAFF_LIMITED['id'];
            } else {
                $roleId = RoleHelper::getRoleIdByTitle($data['level']);
            }

            // update user role
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($staff->userRole, ['roleId' => $roleId]);
        }

       // DB::commit();

        return $staff;
    }

    /**
     * @inheritDoc
     */
    public function deleteStaff(\ArrayAccess $staff, array $data = []): bool
    {
        DB::beginTransaction();

        $userRoleRepository = app(UserRoleRepository::class);
        $userRoleRepository->delete($staff->userRole);

        if (isset($data['completeDeletion'])) {

            //remove all roles
            $userRoles = $userRoleRepository->model->where(['userId' => $staff->user->id])->get();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }

            //remove all users
            $userRepository = app(UserRepository::class);
            $userRepository->delete($staff->user);
        }

        parent::delete($staff);

        DB::commit();

        return true;
    }
}
