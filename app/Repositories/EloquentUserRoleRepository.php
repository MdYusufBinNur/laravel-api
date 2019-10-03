<?php


namespace App\Repositories;


use App\DbModels\Role;
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

    public function getUserIdsOfThePropertyResidents(int $propertyId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->whereIn('roleId', [Role::ROLE_RESIDENT_STUDENT['id'], Role::ROLE_RESIDENT_SHOP['id'], Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_OWNER['id']])
            ->pluck('userId')->toArray();
    }

    public function getUserIdsOfThePropertyStaffs(int $propertyId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->whereIn('roleId', [Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id'], Role::ROLE_STAFF_PRIORITY['id']])
            ->pluck('userId')->toArray();
    }

    public function getUserIdsOfByRoleId(int $propertyId, int $roleId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->where(['roleId' => $roleId])
            ->pluck('userId')->toArray();
    }

}
