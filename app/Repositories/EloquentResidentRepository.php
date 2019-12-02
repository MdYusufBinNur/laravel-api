<?php


namespace App\Repositories;


use App\DbModels\ResidentAccessRequest;
use App\DbModels\Role;
use App\DbModels\Unit;
use App\DbModels\User;
use App\Events\Resident\ResidentCreatedEvent;
use App\Services\Helpers\RoleHelper;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentResidentRepository extends EloquentBaseRepository implements ResidentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (array_key_exists('user', $data)) {
            $data['role']['propertyId'] = $data['propertyId'];

            $userRepository = app(UserRepository::class);
            $user = $userRepository->save($data['user']);
            $data['userId'] = $user->id;
        }

        if(array_key_exists('type', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['type']);
        } else {
            $roleId = Role::ROLE_RESIDENT_TENANT['id'];
        }

        //create user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => $roleId, 'propertyId' => $data['propertyId'], 'userId' => $data['userId']]);

        $data['userRoleId'] = $userRole->id;
        $data['type'] = RoleHelper::getRoleTitleById($roleId);

        if (!isset($data['joiningDate'])) {
            $data['joiningDate'] = Carbon::now()->toDateString();
        }

        $resident = parent::save($data);

        DB::commit();

        // fire resident created event
        event(new ResidentCreatedEvent($resident));

        return $resident;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        //update the user
        if (array_key_exists('user', $data)) {
            $userRepository = app(UserRepository::class);
            $userRepository->updateUser($model->user, $data['user']);
        }

        // update user's role
        if(array_key_exists('type', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['type']);

            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($model->userRole, ['roleId' => $roleId]);
        }

        $resident = parent::update($model, $data);

        DB::commit();

        return $resident;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['resident.user' => 'user', 'resident.unit' => 'unit', 'user.roles' => 'user.userRoles', 'user.profilePic' => 'user.userProfilePics'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function deleteResident(\ArrayAccess $resident, array $data = []): bool
    {
        DB::beginTransaction();
        $userRoleRepository = app(UserRoleRepository::class);
        $residentArchiveRepository = app(ResidentArchiveRepository::class);

        // at first archive the resident
        $residentArchiveRepository->saveByResident($resident);

        //2nd remove the user's role
        $userRoleRepository->delete($resident->userRole);

        if (isset($data['completeDeletion'])) {

            //remove all roles
            $userRoles = $userRoleRepository->model->where(['userId' => $resident->user->id])->get();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }

            //remove all users
            $userRepository = app(UserRepository::class);
            $userRepository->delete($resident->user);
        }

        parent::delete($resident);

        //N.B. not deleting user intentionally

        DB::commit();


        return true;
    }

    /**
     * @inheritDoc
     */
    public function getResidentsByUnits(array $searchCriteria = [])
    {
        $userRepository = app(UserRepository::class);

        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();
        $residentAccessRequestModelTable = ResidentAccessRequest::getTableName();
        $unitModelTable = Unit::getTableName();

        // get all residents
        $residentBuilder = $this->model->where($thisModelTable . '.propertyId', $searchCriteria['propertyId']);

        if (isset($searchCriteria['unitId'])) {
            $residentBuilder->where($thisModelTable . '.unitId', $searchCriteria['unitId']);
        }
        $residentBuilder = $residentBuilder->select($thisModelTable . '.id', 'units.title', $thisModelTable . '.unitId', 'users.id as userId', 'users.name', 'users.email')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->join($unitModelTable, $unitModelTable . '.id', '=', $thisModelTable . '.unitId');


        if (!empty($searchCriteria['pastResident'])) {

            //get all past residents
            $residents = $residentBuilder->onlyTrashed()->get()->toArray();

        } else {

            $residents = $residentBuilder->get()->toArray();

            // get all residents by access request
            $residentAccessRequestRepository = app(ResidentAccessRequestRepository::class);
            $residentAccessRequestsQueryBuilder = $residentAccessRequestRepository->model;

            if (isset($searchCriteria['unitId'])) {
                $residentAccessRequestsQueryBuilder = $residentAccessRequestsQueryBuilder->where($residentAccessRequestModelTable . '.unitId', $searchCriteria['unitId']);
            }

            $residentAccessRequests = $residentAccessRequestsQueryBuilder->where($residentAccessRequestModelTable . '.propertyId', $searchCriteria['propertyId'])
                ->select($residentAccessRequestModelTable . '.id as residentAccessRequestId', $unitModelTable . '.title', $residentAccessRequestModelTable . '.unitId', $residentAccessRequestModelTable . '.name', $residentAccessRequestModelTable . '.email')
                ->join($unitModelTable, $residentAccessRequestModelTable . '.unitId', '=', $unitModelTable . '.id')
                ->get()->toArray();

            // merge residents and to be resident (access request)
            $residents = array_merge($residents, $residentAccessRequests);
        }

        // group by units
        $residentsByUnits = [];
        foreach ($residents as $index => $resident) {

            //todo too many DB calls
            if (isset($resident['userId'])) {
                $resident['profilePic'] = $userRepository->getProfilePicByUserId($resident['userId']);
            }
            $residentsByUnits[$resident['title']][$index] = $resident;
        }

        return $residentsByUnits;
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
            $searchCriteria['id'] = $this->model->where('contactEmail', 'like', '%' . $searchCriteria['query'] . '%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['withName'])) {
            $residentIds = $this->getResidentsIdsByName($searchCriteria);
            $searchCriteria['id'] =  isset($searchCriteria['id']) ? array_merge($searchCriteria['id'], $residentIds) : $residentIds;
            unset($searchCriteria['withName']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = is_array($searchCriteria['id']) ? implode(",", array_unique($searchCriteria['id'])) : $searchCriteria['id'];
        }

        return $searchCriteria;
    }


    /**
     * @inheritDoc
     */
    public function moveOutResidents(array $residentIds): bool
    {
        $hasDeletedAny = false;
        $residents = $this->model->whereIn('id', $residentIds)->get();
        foreach ($residents as $resident) {
            $this->delete($resident);
            $hasDeletedAny = true;
        }

        return $hasDeletedAny;
    }

    /**
     * @inheritDoc
     */
    public function transferResidents(array $data)
    {
        $residents = $this->model->whereIn('id', $data['residentIds'])->get();
        unset($data['residentIds']);
        foreach ($residents as $resident) {
            $residents[] = $this->update($resident, $data);
        }

        return $residents;
    }

    /**
     * @inheritDoc
     */
    public function getResidentsIdsByName(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();

        return $this->model->where('propertyId', $searchCriteria['propertyId'])
            ->select($thisModelTable . '.id')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->where($userModelTable . '.name', 'like', '%' . $searchCriteria['withName'] . '%')
            ->pluck('id')->toArray();

    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfTheTowersResidents(array $towerIds)
    {
        $thisModelTable = $this->model->getTable();
        $unitTable = Unit::getTableName();

        return $this->model
            ->select($thisModelTable . '.*')
            ->join($unitTable, $thisModelTable . '.unitId', '=', $unitTable . '.id')
            ->whereIn($unitTable . '.towerId', $towerIds)
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfTheFloorsResidents(int $towerId, array $floors)
    {
        $thisModelTable = $this->model->getTable();
        $unitTable = Unit::getTableName();

        return $this->model
            ->select($thisModelTable . '.userId')
            ->join($unitTable, $thisModelTable . '.unitId', '=', $unitTable . '.id')
            ->where($unitTable . '.towerId', $towerId)
            ->whereIn($unitTable . '.floor', $floors)
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfTheLinesResidents(int $towerId, array $lines)
    {
        $thisModelTable = $this->model->getTable();
        $unitTable = Unit::getTableName();

        return $this->model
            ->select($thisModelTable . '.userId')
            ->join($unitTable, $thisModelTable . '.unitId', '=', $unitTable . '.id')
            ->where($unitTable . '.towerId', $towerId)
            ->whereIn($unitTable . '.line', $lines)
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfTheUnitsResidents(array $unitIds)
    {
        return $this->model
            ->whereIn('unitId', $unitIds)
            ->pluck('userId')->toArray();
    }

}
