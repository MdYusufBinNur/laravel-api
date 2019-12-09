<?php
namespace App\Repositories;

use App\DbModels\EnterpriseUser;
use App\Repositories\Contracts\PropertyRepository;
use App\Services\Helpers\HostsHelper;
use Illuminate\Support\Facades\DB;

class EloquentPropertyRepository extends EloquentBaseRepository implements PropertyRepository
{
    /**
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        if(isset($data['latitude']) && isset($data['longitude'])){
            $data['point'] = DB::raw("(GeomFromText('POINT(" . $data['latitude']. ' ' .$data['longitude'] .")'))");
        }
        return parent::save($data);
    }

    /**
     * @inheritdoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        if(isset($data['latitude']) && isset($data['longitude'])){
            $point = (string) "(GeomFromText('POINT(" . $data['latitude']. ' ' .$data['longitude'] .")'))" ;
            $data['point'] = DB::raw($point);
        }
        return parent::update($model, $data);
    }

    /**
     * @inheritdoc
     */
    public function findByHost($host): ?\ArrayAccess
    {
        $searchCriteria = [];
        if (!ctype_digit($host)) {
            $searchCriteria = HostsHelper::getSearchCriteriaForAHost($host);
        }

        return parent::findOneBy($searchCriteria);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['property.designSettings' => 'propertyDesignSetting', 'property.images' => 'propertyImages','property.company' => 'company' ];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        $loggedInUser = $this->getLoggedInUser();

        if (!$loggedInUser->isAdmin()) {
            if ($loggedInUser->isEnterpriseUser()) {
                $enterpriseUser = $loggedInUser->enterpriseUser;
                if ($enterpriseUser instanceof EnterpriseUser) {
                    $searchCriteria['id'] = $enterpriseUser->enterPriseUserProperties()->pluck('propertyId')->toArray();
                }
            } else {
                $searchCriteria['id'] = [];
            }
        }
        
        if (array_key_exists('host', $searchCriteria)) {
            $hostSearchCriteria = HostsHelper::getSearchCriteriaForAHost($searchCriteria['host']);
            $searchCriteria = array_merge($searchCriteria, $hostSearchCriteria);
            unset($searchCriteria['host']);
        }

        if (isset($searchCriteria['query'])) {
            $propertyIds = $this->model
                ->where('title', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('type', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('subdomain', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();

            $searchCriteria['id'] = isset($searchCriteria['id']) ? array_intersect($searchCriteria['id'], $propertyIds) : $propertyIds;

            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['id']) && is_array($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }


}
