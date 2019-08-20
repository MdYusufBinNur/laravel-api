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

            if(array_key_exists('roleId', $data['users'])) {
                $roleId = $data['users']['roleId'];
            }
            else {
                $roleId = Role::ROLE_ENTERPRISE_STANDARD['id'];
            }
            $data['roles']['roleId'] = $roleId;

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

    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $enterpriseUser = parent::update($model, $data);

        if(array_key_exists('propertyId', $data)) {
            $enterpriseUserPropertyRepository = app(EnterpriseUserPropertyRepository::class);
            $enterpriseUserPropertyDataToCheck = ['enterpriseUserId' => $enterpriseUser->id, 'propertyId'=> $data['propertyId']];
            $enterpriseUserPropertyDataToSave = ['enterpriseUserId' => $enterpriseUser->id, 'propertyId'=> $data['propertyId']];

            if (isset($data['oldPropertyId'])) {
                $enterpriseUserPropertyDataToCheck['propertyId'] = $data['oldPropertyId'];
                $enterpriseUserPropertyRepository->patch($enterpriseUserPropertyDataToCheck, $enterpriseUserPropertyDataToSave);
            } else {
                $enterpriseUserPropertyRepository->patch($enterpriseUserPropertyDataToCheck, $enterpriseUserPropertyDataToSave);
            }

        }

        DB::commit();

        return $enterpriseUser;
    }
}
