<?php


namespace App\Repositories;


use App\DbModels\Admin;
use App\DbModels\User;
use App\Helpers\RoleHelper;
use App\Repositories\Contracts\AdminRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

class EloquentAdminRepository extends EloquentBaseRepository implements AdminRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['admin.user' => 'user'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if(array_key_exists('users', $data)) {
            //create user
            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['users']));
            $data['userId'] = $user->id;
        }
//
//        if(array_key_exists('roleId', $data['users'])) {
//            $roleId = $data['users']['roleId'];
//        } else {
//            $roleId = Admin::LEVEL_STANDARD['id'];
//        }
//
//        //create user role
//        $userRoleRepository = app(UserRoleRepository::class);
//        $userRoleRepository->save(['roleId' => $roleId, 'userId' => $data['userId']]);

        // create enterprise user
        $adminUser = parent::save($data);
        DB::commit();

        return $adminUser;
    }

    /**
     *@inherit Doc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $admin = parent::update($model, $data);

        $userRepository = app(UserRepository::class);

        if(isset($data['users'])) {
            $userRepository->updateUser($admin->user, $data['users']);
        }

        DB::commit();

        return $admin;
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (isset($searchCriteria['withName'])) {
            $searchCriteria['id'] = $this->getAdminUserIdsByName($searchCriteria);
            unset($searchCriteria['withName']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function getAdminUserIdsByName(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();

        return $this->model
            ->select($thisModelTable . '.id')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->where($userModelTable . '.name', 'like', '%' . $searchCriteria['withName'] . '%')
            ->orWhere($userModelTable . '.email', 'like', '%' . $searchCriteria['withName'] . '%')
            ->pluck('id')->toArray();
    }

}
