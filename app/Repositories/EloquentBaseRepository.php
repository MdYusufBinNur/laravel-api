<?php

namespace App\Repositories;

use App\DbModels\User;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class EloquentBaseRepository implements BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * EloquentBaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id): ?\ArrayAccess
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria): ?\ArrayAccess
    {
        return $this->model->where($criteria)->first();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [])
    {
        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 50; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        if (isset($searchCriteria['eagerLoad'])) {
            $queryBuilder->with($searchCriteria['eagerLoad']);
        }
        if (isset($searchCriteria['rawOrder'])) {
            $queryBuilder->orderByRaw(DB::raw("FIELD(id, {$searchCriteria['id']})"));
        } else {
            $queryBuilder->orderBy($orderBy, $orderDirection);
        }

        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        // set createdBy by loggedInUser if not passed
        if (!isset($data['created_by_user_id'])) {
            $loggedInUser = $this->getLoggedInUser();
            if ($loggedInUser instanceof User) {
                $data['created_by_user_id'] = $loggedInUser->id;
            }
        }

        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $fillAbleProperties = $this->model->getFillable();

        foreach ($data as $key => $value) {

            // update only fillAble properties
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        // update the model
        $model->save();

        // get updated model from database
        $model = $this->findOne($model->id);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function findIn(string $key, array $values): ?\IteratorAggregate
    {
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * @inheritdoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        return $model->delete();
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $queryBuilder
     * @param array $searchCriteria
     * @return mixed
     */
    protected function applySearchCriteriaInQueryBuilder($queryBuilder, array $searchCriteria = [])
    {
        unset($searchCriteria['include'], $searchCriteria['eagerLoad'], $searchCriteria['rawOrder'] ); //don't need that field for query. only needed for transformer.

        foreach ($searchCriteria as $key => $value) {

            //skip pagination related query params
            if (in_array($key, ['page', 'per_page', 'order_by', 'order_direction'])) {
                continue;
            }

            if ($value == 'null') {
                $queryBuilder->whereNull($key);
            } else {
                if ($value == 'notNull') {
                    $queryBuilder->whereNotNull($key);
                } else {
                    //we can pass multiple params for a filter with commas
                    $allValues = explode(',', $value);

                    if (count($allValues) > 1) {
                        $queryBuilder->whereIn($key, $allValues);
                    } else {

                        $operator = '=';
                        $queryBuilder->where($key, $operator, $value);
                    }
                }
            }
        }

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function updateIn(string $key, array $values, array $data): \IteratorAggregate
    {
        // updated records
        $this->model->whereIn($key, $values)->update($data);

        // return updated records QueryBuilder
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * get modified fields
     *
     * @param $model
     * @param $data
     * @return array
     */
    public function getModifiedFields($model, $data)
    {
        $fillAbleProperties = $model->getFillable();

        foreach ($data as $key => $value) {
            // update only fillAble properties
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        return $model->getDirty();
    }

    /**
     * get loggedIn user
     *
     * @return User
     */
    protected function getLoggedInUser()
    {
        if (\Auth::user() instanceof User) {
            return \Auth::user();
        } else {
            return new User();
        }
    }

    /**
     * paginate custom data
     *
     * @param array $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    protected function paginateData($items, $perPage = 15, $page = null, array $options = []) : LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
