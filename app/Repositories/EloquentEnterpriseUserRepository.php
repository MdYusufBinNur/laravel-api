<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\DbModels\User;
use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Services\Helpers\RoleHelper;
use App\Repositories\Contracts\EnterpriseUserPropertyRepository;
use App\Repositories\Contracts\EnterpriseUserRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

class EloquentEnterpriseUserRepository extends EloquentBaseRepository implements EnterpriseUserRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['eu.user' => 'user','eu.properties' => 'enterPriseUserProperties'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (array_key_exists('users', $data)) {
            
            //create user
            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['users']));
            $data['userId'] = $user->id;
        }

        if (array_key_exists('level', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['level']);
        } else {
            $roleId = Role::ROLE_ENTERPRISE_STANDARD['id'];
        }

        //create user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => $roleId, 'userId' => $data['userId']]);

        $data['userRoleId'] = $userRole->id;
        $data['level'] = RoleHelper::getRoleTitleById($roleId);

        // create enterprise user
        $enterpriseUser = parent::save($data);

        if ($data['level'] == Role::ROLE_ENTERPRISE_STANDARD['title']) {
            //todo, duplicate snippet in the update method
            //to save propertyId in EnterpriseUserProperty table if property is exists for the enterprise user
            if (array_key_exists('propertyIds', $data)) {
                $enterpriseUserPropertyRepository = app(EnterpriseUserPropertyRepository::class);
                $propertyIds = explode(',', $data['propertyIds']);
                foreach ($propertyIds as $property) {
                    $enterpriseUserPropertyRepository->save(['enterpriseUserId' => $enterpriseUser->id, 'propertyId' => $property]);
                }
            }
        }
        
        // fire EnterpriseUserCreatedEvent
        event(new EnterpriseUserCreatedEvent($enterpriseUser, $data));

        DB::commit();

        return $enterpriseUser;
    }

    /**
     * @inheritDoc
     */
    public function updateEnterpriseUser(\ArrayAccess $model, array $data): \ArrayAccess
    {

        DB::beginTransaction();

        $enterpriseUser = parent::update($model, $data);

        if (array_key_exists('propertyIds', $data)) {
            $enterpriseUserPropertyRepository = app(EnterpriseUserPropertyRepository::class);

            $enterpriseUserPropertyRepository->model->where(['enterpriseUserId' => $enterpriseUser->id])->delete();
            $propertyIds = explode(',', $data['propertyIds']);
            foreach ($propertyIds as $propertyId) {
                if (!empty($propertyId)) {
                    $enterpriseUserPropertyData = ['enterpriseUserId' => $enterpriseUser->id, 'propertyId' => $propertyId];
                    $enterpriseUserPropertyRepository->patch($enterpriseUserPropertyData, $enterpriseUserPropertyData);
                }
            }
        }


        if (isset($data['users'])) {
            $userRepository = app(UserRepository::class);
            $userRepository->updateUser($enterpriseUser->user, $data['users']);
        }


        if (array_key_exists('level', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['level']);

            // update user role
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($enterpriseUser->userRole, ['roleId' => $roleId]);
        }

        DB::commit();

        return $enterpriseUser;
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
            $searchCriteria['enterpriseUserId'] = $this->model->where('contactEmail', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('title', 'like', '%' . $searchCriteria['query'] . '%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['withName'])) {
            $searchCriteria['userId'] = $this->getEnterpriseUserIdsByName($searchCriteria);
            unset($searchCriteria['withName']);
        }

        if(isset($searchCriteria['enterpriseUserId']) && isset($searchCriteria['userId'])) {
            $searchCriteria['id'] = array_merge($searchCriteria['enterpriseUserId'], $searchCriteria['userId']);
        } else if (isset($searchCriteria['enterpriseUserId'])){
            $searchCriteria['id'] = $searchCriteria['enterpriseUserId'];
        } else if(isset($searchCriteria['userId'] )){
            $searchCriteria['id'] = $searchCriteria['userId'];
        }
        unset($searchCriteria['enterpriseUserId']);
        unset($searchCriteria['userId']);

        if (isset($searchCriteria['id']) && is_array($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function getEnterpriseUserIdsByName(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();

        return $this->model
            ->select($thisModelTable . '.id')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->where($userModelTable . '.name', 'like', '%' . $searchCriteria['withName'] . '%')
            ->pluck('id')->toArray();
    }
    /*
     * @inheritDoc
     */
    public function deleteEnterpriseUser(\ArrayAccess $enterpriseUser, array $data = []): bool
    {
        DB::beginTransaction();

        $userRoleRepository = app(UserRoleRepository::class);
        $userRoleRepository->delete($enterpriseUser->userRole);

        if (isset($data['completeDeletion'])) {

            //remove all roles
            $userRoles = $userRoleRepository->model->where(['userId' => $enterpriseUser->user->id])->get();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }

            //remove all users
            $userRepository = app(UserRepository::class);
            $userRepository->delete($enterpriseUser->user);
        }

        parent::delete($enterpriseUser);

        DB::commit();

        return true;
    }
}
