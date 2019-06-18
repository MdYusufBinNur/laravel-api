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
}
