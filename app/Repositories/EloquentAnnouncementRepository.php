<?php


namespace App\Repositories;


use App\Repositories\Contracts\AnnouncementRepository;
use Carbon\Carbon;

class EloquentAnnouncementRepository extends EloquentBaseRepository implements AnnouncementRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $announcements =  parent::findBy($searchCriteria, $withTrashed);

        return $announcements;
    }

    /**
     * @inheritDoc
     */
    public function getAnnouncementsForLds(array $searchCriteria)
    {
        $queryBuilder = $this->model
            ->where('showOnLds', 1)
            ->whereDate('expireAt', '>=', Carbon::now())
            ->where('propertyId', $searchCriteria['propertyId']);

        return $queryBuilder->get();
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
            $searchCriteria['id'] = $this->model->where('title', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if(isset($searchCriteria['isExpired'])){
            if ($searchCriteria['isExpired']) {
                $searchCriteria['id'] = $this->model->whereDate('expireAt', '<=', $searchCriteria['expireAt'])
                    ->pluck('id')->toArray();
            } else{
                $searchCriteria['id'] = $this->model->whereDate('expireAt', '>=', $searchCriteria['expireAt'])
                    ->pluck('id')->toArray();
            }
            unset($searchCriteria['isExpired']);
            unset($searchCriteria['expireAt']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

}
