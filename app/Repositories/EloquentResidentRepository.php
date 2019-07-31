<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

class EloquentResidentRepository extends EloquentBaseRepository implements ResidentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if(array_key_exists('user', $data)){
            $data['role']['propertyId'] = $data['propertyId'];

            if(array_key_exists('roleId', $data['user'])) {
                $data['role']['roleId'] = $data['user']['roleId'];
            } else {
                $data['role']['roleId'] = Role::ROLE_RESIDENT_TENANT['id'];
            }

            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['user'], ['role' => $data['role']]));
            $data['userId'] = $user->id;
        }

        $resident = parent::save($data);
        DB::commit();

        return $resident;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = isset($searchCriteria['include']) ? ['user', 'user.userRoles'] : [];
        return parent::findBy($searchCriteria);
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $resident): bool
    {
        DB::beginTransaction();
        $userRoleRepository = app(UserRoleRepository::class);
        $residentArchiveRepository = app(ResidentArchiveRepository::class);

        // at first archive the resident
        $residentArchiveRepository->saveByResident($resident);

        //2nd remove the user's role
        $userRole = $userRoleRepository->model
            ->where(['userId' => $resident->user->id, 'propertyId' => $resident->propertyId])
            ->whereIn('roleId', [Role::ROLE_RESIDENT_OWNER['id'], Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_SHOP['id'], Role::ROLE_RESIDENT_STUDENT['id']])
            ->first();
        $userRoleRepository->delete($userRole);

        parent::delete($resident);

        //N.B. not deleting user intentionally

        DB::commit();



        return true;
    }
}
