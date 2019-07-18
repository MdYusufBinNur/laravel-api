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
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        $cacheKey = 'findBy:user-search:' . json_encode($searchCriteria);
        if (($user = $this->getCacheByKey($cacheKey))) {
            return $user;
        }

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['userRoles'];

        $users =  parent::findBy($searchCriteria, $withTrashed);

        $this->setCacheByKey($cacheKey, $users);

        return $users;
    }

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
        $userRoleRepository->save(['roleId' => $role->id, 'userId' => $user->id, 'propertyId' => $data['roles']['propertyId'] ]);

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

            $userRoleRepository->save(['roleId' => $data['roles']['roleId'], 'userId' => $data['id'], 'propertyId' => $data['roles']['propertyId']]);

        } else if(array_key_exists('roles', $data)) {

            $userRole = $userRoleRepository->findOneBy(['id' => $data['roles']['id']]);
            $userRoleRepository->update($userRole, $data['roles']);
        }

        return $user;
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model->where('email', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('name', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['roleId'])) {
            $userRoleRepository = app(UserRoleRepository::class);
            $userIds = $userRoleRepository->model->where('roleId', $searchCriteria['roleId'])->pluck('userId')->toArray();
            $searchCriteria['id'] = isset($searchCriteria['id']) ? array_intersect($searchCriteria['id'], $userIds) : $userIds;
            unset($searchCriteria['roleId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }
        return $searchCriteria;
    }
}
