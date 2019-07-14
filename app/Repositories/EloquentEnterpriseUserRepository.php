<?php


namespace App\Repositories;


use App\Repositories\Contracts\EnterpriseUserPropertyRepository;
use App\Repositories\Contracts\EnterpriseUserRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentEnterpriseUserRepository extends EloquentBaseRepository implements EnterpriseUserRepository
{
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRepository = app(UserRepository::class);
        $user = $userRepository->save(array_merge($data['users'], array('roles' => $data['roles'])));

        $data['userId'] = $user->id;
        $enterpriseUser = parent::save($data);

        if(array_key_exists('propertyId', $data))
        {
            $enterpriseUserPropertyRepository = app(EnterpriseUserPropertyRepository::class);
            $enterpriseUserPropertyRepository->save(['enterpriseUserId' => $enterpriseUser->id, 'propertyId'=>$data['propertyId']]);
        }

        DB::commit();

        return $enterpriseUser;
    }
}
