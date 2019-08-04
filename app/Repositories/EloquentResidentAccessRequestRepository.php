<?php


namespace App\Repositories;


use App\DbModels\ResidentAccessRequest;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EloquentResidentAccessRequestRepository extends EloquentBaseRepository implements ResidentAccessRequestRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        if (!isset($data['movedInDate'])) {
            $data['movedInDate'] = Carbon::now()->toDateString();
        }
        $data['pin'] = $this->generatePin();
        return parent::save($data);
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        if (!empty($data['regeneratePin'])) {
            unset($data['regeneratePin']);
            $data['pin'] = $this->generatePin();
        }
        return parent::update($model, $data);
    }


    /**
     * @inheritDoc
     */
    public function generatePin() : string
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

}
