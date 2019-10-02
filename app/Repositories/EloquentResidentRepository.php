<?php


namespace App\Repositories;


use App\DbModels\ResidentAccessRequest;
use App\DbModels\Role;
use App\DbModels\Unit;
use App\DbModels\User;
use App\DbModels\UserRole;
use App\Events\Resident\ResidentCreatedEvent;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

            if (array_key_exists('roleId', $data['user'])) {
                $data['role']['roleId'] = $data['user']['roleId'];
            } else {
                $data['role']['roleId'] = Role::ROLE_RESIDENT_TENANT['id'];
            }

            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['user'], ['role' => $data['role']]));
            $data['userId'] = $user->id;
        }

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
        if (array_key_exists('user', $data)) {

            $data['role']['propertyId'] = $data['propertyId'];
            $data['role']['roleId'] = $data['user']['roleId'];

            $userRepository = app(UserRepository::class);
            $user = $userRepository->findOneBy(['id' => $data['user']['id']]);
            if ($user instanceof User) {
                $userRepository->updateUser($user, array_merge($data['user'], ['role' => $data['role']]));
            } else {
                throw new NotFoundHttpException();
            }
        }

        return parent::update($model, $data);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['resident.user' => 'user', 'resident.unit' => 'unit', 'user.roles' => 'user.userRoles', 'user.profilePic' => 'user.userProfilePic'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $resident): bool
    {
        DB::beginTransaction();
        $userRoleRepository = app(UserRoleRepository::class);
        $residentArchiveRepository = app(ResidentArchiveRepository::class);

        // at first archive the resident
        $residentArchiveRepository->saveByResident($resident);

        //2nd remove the user's role
        $userRole = $userRoleRepository->model
            ->where(['userId' => $resident->user->id, 'propertyId' => $resident->propertyId])
            ->whereIn('roleId', [Role::ROLE_RESIDENT_OWNER['id'], Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_SHOP['id'], Role::ROLE_RESIDENT_STUDENT['id']])
            ->first();
        if ($userRole instanceof UserRole) {
            $userRoleRepository->delete($userRole);
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
            $searchCriteria['id'] = $this->getResidentsByName($searchCriteria);
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
        $residents = $this->model->whereIn('id', json_decode($data['residentIds']))->get();
        unset($data['residentIds']);
        foreach ($residents as $resident) {
            $residents[] = $this->update($resident, $data);
        }

        return $residents;
    }

    public function getResidentsByName(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();

        // get all residents
        $residentBuilder = $this->model->where('propertyId', $searchCriteria['propertyId']);

        $residentIds = $residentBuilder->select($thisModelTable.'.id')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->where($userModelTable.'.name', 'like', '%' . $searchCriteria['withName'] . '%')
            ->pluck('id')->toArray();

        return $residentIds;
    }

}
