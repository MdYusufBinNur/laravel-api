<?php

namespace App\Repositories;


trait EloquentEagerLoadTrait
{
    /**
     * get eager loaded relationships
     *
     * @param string $includeString
     * @param array $eagerLoads
     * @return array
     */
    public function eagerLoadWithIncludeParam(string $includeString, array $eagerLoads)
    {
        $requestedRelationships = explode(',', $includeString);

        $shouldLoadRelationships = [];
        foreach ($requestedRelationships  as $relationship) {
            if (isset($eagerLoads[$relationship])) {
                $shouldLoadRelationships[] = $eagerLoads[$relationship];
            }
        }
        return $shouldLoadRelationships;
    }


}
