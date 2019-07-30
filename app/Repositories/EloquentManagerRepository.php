<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\DbModels\UserRole;
use App\Repositories\Contracts\ManagerRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

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
        $userRoleRepository = app(UserRoleRepository::class);
        if (isset($data['userId'])) {
            $user = $userRepository->findOne($data['userId']);
        } else {
            $user = $userRepository->save($data['user']);
        }

        $data['role']['userId'] = $user->id;
        $data['role']['propertyId'] = $data['propertyId'];
        $userRoleRepository->save($data['role']);

        $data['userId'] = $user->id;
        $manager = parent::save($data);

        DB::commit();

        return $manager;

    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $staff = parent::update($model, $data);
        $userRepository = app(UserRepository::class);

        if(isset($data['user'])) {
            $userRepository->update($staff->user, $data['user']);
        }

        if(isset($data['role'])) {
            $userRoleRepository = app(UserRoleRepository::class);

            $data['role']['propertyId'] = $data['propertyId'] ?? $staff->propertyId;

            if (isset($data['role']['addNewRole'])) {
                unset($data['role']['addNewRole']);
                $data['role']['userId'] = $staff->user->id;
                $userRoleRepository->patch($data['role'], $data['role']);
            } else {
                $userRole = $userRoleRepository->findOneBy(['userId' => $staff->user->id, 'propertyId' => $data['role']['propertyId']]);
                $userRoleRepository->update($userRole, $data['role']);
            }
        }

        DB::commit();

        return $staff;
    }

    /**
     * @inheritDoc
     */
    public function deleteStaff(\ArrayAccess $staff, array $data = []): bool
    {
        DB::beginTransaction();
        $userRoleRepository = app(UserRoleRepository::class);
        $userRepository = app(UserRepository::class);

        if (isset($data['role'])) {
            $userRoles = $userRoleRepository->model->where($data['role'])->count();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }
        }

        if (isset($data['completeDeletion'])) {
            $userRoles = $userRoleRepository->model->where(['userId' => $staff->user->id])->get();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }

            $userRepository->delete($staff->user);
        }

        parent::delete($staff);

        DB::commit();


        return true;
    }
}
