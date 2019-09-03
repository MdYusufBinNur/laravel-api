<?php


namespace App\Repositories;


use App\Repositories\Contracts\PropertyImageRepository;
use Illuminate\Support\Arr;

class EloquentPropertyImageRepository extends EloquentBaseRepository implements PropertyImageRepository
{
    /**
     * @inheritDoc
     */
    public function setPropertyImage(array $data): \ArrayAccess
    {
        $searchCriteria = Arr::only($data, ['propertyId', 'imageId', 'type']);
        return $this->patch($searchCriteria, $data);
    }

}
