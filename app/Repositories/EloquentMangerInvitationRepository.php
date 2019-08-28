<?php


namespace App\Repositories;


use App\DbModels\ManagerInvitation;
use App\Repositories\Contracts\MangerInvitationRepository;
use Illuminate\Support\Str;

class EloquentMangerInvitationRepository extends EloquentBaseRepository implements MangerInvitationRepository
{
    /**
     * inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['pin'] = $this->generatePin();

        return parent::save($data); //
    }

    /**
     * @inheritDoc
     */
    public function generatePin(): string
    {
        $isUniquePin = true;
        $pin = '';
        while ($isUniquePin) {
            $pin = strtoupper(Str::random(10));
            if (!$this->findOneBy(['pin' => $pin]) instanceof ManagerInvitation) {
                $isUniquePin = false;
            }
        }
        return $pin;
    }
}
