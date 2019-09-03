<?php


namespace App\Repositories;


use App\Repositories\Contracts\PropertySocialMediaRepository;

class EloquentPropertySocialMediaRepository extends EloquentBaseRepository implements PropertySocialMediaRepository
{
    /**
     * @inheritDoc
     */
    public function savePropertySocialMedia(array $data)
    {
        $propertySocialMediaIds = [];
        foreach ($data['propertySocialMedia'] as $propertySocialMedia) {
            $searchCriteria = ['propertyId' => $data['propertyId'], 'type' => $propertySocialMedia['type']];
            $dataToSave = $propertySocialMedia;
            $dataToSave['propertyId'] = $data['propertyId'];
            $propertySocialMediaIds[] = $this->patch($searchCriteria, $dataToSave)['id'];
        }

        return $this->model->whereIn('id', $propertySocialMediaIds)->get();
    }

}
