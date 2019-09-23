<?php


namespace App\Repositories;


use App\DbModels\Event;
use App\DbModels\Resident;
use App\Repositories\Contracts\EventRepository;
use App\Repositories\Contracts\EventSignupRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentEventSignupRepository extends EloquentBaseRepository implements EventSignupRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $eventRepository = app(EventRepository::class);
        $event = $eventRepository->findOne($data['eventId']);

        if ($event instanceof Event) {

            //todo move this to model scope
            $data['userId'] = $this->getLoggedInUser()->id;
            $resident = $this->getLoggedInUser()->residents()->where(['propertyId' => $event->propertyId, 'userId' => $data['userId']])->first();

            if ($resident instanceof Resident) {
                $data['residentId'] = $resident->id;
            }
        }

        //todo in policy need to check if the user has permission to signup in this property
        $eventSignup = $this->patch(
            ['eventId' => $data['eventId'], 'residentId' => $data['residentId']],
            $data
        );

        DB::commit();

        return $eventSignup;
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $eventModelTable = Event::getTableName();

        $queryBuilder = $this->model
            ->select($thisModelTable . '.*')
            ->join($eventModelTable, $thisModelTable . '.eventId', '=', $eventModelTable . '.id');

        if (isset($searchCriteria['propertyId'])) {
            $queryBuilder = $queryBuilder->where($eventModelTable . '.propertyId', $searchCriteria['propertyId']);
            unset($searchCriteria['propertyId']);
        }

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate($eventModelTable . '.date', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate($eventModelTable . '.date', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        foreach ($searchCriteria as $key => $value) {
            if ($key != 'include') {
                $searchCriteria[$thisModelTable . '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $thisModelTable . '.' . $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }
}
