<?php


namespace App\Repositories;


use App\DbModels\ResidentAccessRequest;
use App\DbModels\ResidentArchive;
use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ResidentArchiveRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EloquentResidentAccessRequestRepository extends EloquentBaseRepository implements ResidentAccessRequestRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        if (isset($data['accessInPast'])) {
            $isResidentArchive = $this->hadAccessInThePast($data['email']);

            if ($isResidentArchive) {
                // TODO: will be moved resident archive to active resident
                // there is high chance there is still soft deleted resident in residents table
                // just need to update the resident
            }
        }

        unset($data['accessInPast']);

        if (!isset($data['movedInDate'])) {
            $data['movedInDate'] = Carbon::now()->toDateString();
        }

        $data['pin'] = $this->generatePin();

        $residentAccessRequest = parent::save($data);

        // fire resident access request created event
        event(new ResidentAccessRequestCreatedEvent($residentAccessRequest, $data));

        return $residentAccessRequest;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $oldResidentAccessRequest = clone $model;
        if (!empty($data['regeneratePin'])) {
            unset($data['regeneratePin']);
            $data['pin'] = $this->generatePin();
        }

        $residentAccessRequest = parent::update($model, $data);

        // fire resident access request updated event
        event(new ResidentAccessRequestUpdatedEvent($residentAccessRequest, array_merge($data, ['oldResidentAccessRequest' => $oldResidentAccessRequest])));

        return $residentAccessRequest;
    }


    /**
     * @inheritDoc
     */
    public function generatePin(): string
    {
        $isUniquePin = true;
        $pin = '';
        while ($isUniquePin) {
            $pin = strtoupper(Str::random(6));
            if (!$this->findOneBy(['pin' => $pin]) instanceof ResidentAccessRequest) {
                $isUniquePin = false;
            }
        }
        return $pin;
    }

    /**
     * @inheritDoc
     */
    public function hadAccessInThePast($data)
    {
        $residentArchiveRepository = app(ResidentArchiveRepository::class);
        if ($residentArchiveRepository->findOneBy(['email' => $data]) instanceof ResidentArchive) {
            return true;
        }
    }

}
