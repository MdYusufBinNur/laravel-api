<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{

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

        $roleRepository = app(RoleRepository::class);
        $role = $roleRepository->findOneBy(['id' => $data['roles']['roleId']]);
        $userRoleRepository = app(UserRoleRepository::class);
        $userRoleRepository->save(['roleId' => $role->id, 'userId' => $user->id ]);

        DB::commit();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $userRoleRepository = app(UserRoleRepository::class);

        $user = parent::update($model, $data);

        if(array_key_exists('addNewRole', $data) && array_key_exists('roles', $data)) {

            $userRoleRepository->save(['roleId' => $data['roles']['roleId'], 'userId' => $data['id']]);

        } else if(array_key_exists('roles', $data)) {

            $userRole = $userRoleRepository->findOneBy(['id' => $data['roles']['id']]);
            $userRoleRepository->update($userRole,['roleId' => $data['roles']['roleId']]);
        }

        return $user;
    }
}
