<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserRoleRepository;

class EloquentUserRoleRepository extends EloquentBaseRepository implements UserRoleRepository
{
    /**
     * @inheritDoc
     */
    public function getUserIdsOfEntireProperty(int $propertyId)
    {
        return $this->model->select(['userId'])->where(['propertyId' => $propertyId])->pluck('userId')->toArray();
    }

}
