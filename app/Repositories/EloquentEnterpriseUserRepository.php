<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\Repositories\Contracts\EnterpriseUserPropertyRepository;
use App\Repositories\Contracts\EnterpriseUserRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentEnterpriseUserRepository extends EloquentBaseRepository implements EnterpriseUserRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if(array_key_exists('users', $data)) {

            if(array_key_exists('propertyId', $data)) {
                $data['roles']['propertyId'] = $data['propertyId'];
            }

            //to get the role id of a role name by const value of a model
            $roleRepository = app(RoleRepository::class);
            $role = $roleRepository->findOneBy(['title' => Role::ROLE_ENTERPRISE_USER]);
            $data['roles']['roleId'] = $role->id;

            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['users'], ['roles' => $data['roles']]));

            $data['userId'] = $user->id;
        }

        $enterpriseUser = parent::save($data);

        //to save propertyId in EnterpriseUserProperty table if property is exists for the enterprise user
        if(array_key_exists('propertyId', $data)) {
            $enterpriseUserPropertyRepository = app(EnterpriseUserPropertyRepository::class);
            $enterpriseUserPropertyRepository->save(['enterpriseUserId' => $enterpriseUser->id, 'propertyId'=>$data['propertyId']]);
        }

        DB::commit();

        return $enterpriseUser;
    }
}
