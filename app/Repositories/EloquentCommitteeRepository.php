<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeRepository;
use App\Repositories\Contracts\CommitteeSessionRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class EloquentCommitteeRepository extends EloquentBaseRepository implements CommitteeRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (isset($searchCriteria['current-committees'])) {
            $committeeSessionRepository = app(CommitteeSessionRepository::class);
            $committeeSessionIds = $committeeSessionRepository->findBy(['withOutPagination'=> true, 'sessionDate' => Carbon::today()])->pluck('id')->toArray();
            if (empty($committeeSessionIds)) {
                return new Collection();
            }
            $searchCriteria['committeeSessionId'] = implode(',', $committeeSessionIds);
            unset($searchCriteria['current-committees']);
        }
        $searchCriteria['eagerLoad'] = ['committee.property' => 'property', 'committee.committeeType' => 'committeeType', 'committee.committeeSession' => 'committeeSession', 'committee.committeeHierarchy' => 'committeeHierarchy', 'committee.user' => 'user'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
