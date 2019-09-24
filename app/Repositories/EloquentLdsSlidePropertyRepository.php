<?php


namespace App\Repositories;


use App\Repositories\Contracts\LdsSlidePropertyRepository;

class EloquentLdsSlidePropertyRepository extends EloquentBaseRepository implements LdsSlidePropertyRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['lsp.property' => 'property', 'lsp.slide' => 'slide'];
        return parent::findBy($searchCriteria, $withTrashed);
    }
}
