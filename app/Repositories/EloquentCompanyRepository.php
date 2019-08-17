<?php
namespace App\Repositories;

use App\Repositories\Contracts\CompanyRepository;

class EloquentCompanyRepository extends EloquentBaseRepository implements CompanyRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['properties','noOfEnterpriseUsers'];

        $companies =  parent::findBy($searchCriteria, $withTrashed);

        return $companies;
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

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }


}
