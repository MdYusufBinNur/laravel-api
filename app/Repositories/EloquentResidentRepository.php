<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentResidentRepository extends EloquentBaseRepository implements ResidentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if(array_key_exists('users', $data)){
            $data['roles']['propertyId'] = $data['propertyId'];

            if(array_key_exists('roleId', $data['users'])) {
                $roleId = $data['users']['roleId'];
            }
            else {
                $roleId = Role::ROLE_RESIDENT_TENANT['id'];
            }

            $data['roles']['roleId'] = $roleId;

            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['users'], ['roles' => $data['roles']]));
            $data['userId'] = $user->id;
        }

        $resident = parent::save($data);
        DB::commit();

        return $resident;
    }
}
