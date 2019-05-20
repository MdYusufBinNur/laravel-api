<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;

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
}
