<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\DbModels\User;
use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Repositories\Contracts\EnterpriseUserPropertyRepository;
use App\Repositories\Contracts\EnterpriseUserRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentEnterpriseUserRepository extends EloquentBaseRepository implements EnterpriseUserRepository
{
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['resident.user' => 'user', 'resident.unit' => 'unit', 'user.roles' => 'user.userRoles', 'user.profilePic' => 'user.userProfilePic'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

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

        // fire EnterpriseUserCreatedEvent
        event(new EnterpriseUserCreatedEvent($enterpriseUser, $data));

        DB::commit();

        return $enterpriseUser;
    }

    public function updateEnterpriseUser(\ArrayAccess $model, array $data): \ArrayAccess
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

        if (isset($searchCriteria['id'])) {
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
}
