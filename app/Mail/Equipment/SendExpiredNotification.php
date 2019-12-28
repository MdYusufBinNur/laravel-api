<?php

namespace App\Mail\Equipment;

use App\DbModels\Equipment;
use App\DbModels\Message;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendExpiredNotification extends Mailable
{
    use SerializesModels;

    /**
     * @var Equipment
     */
    public $equipment;

    /**
     * Create a new message instance.
     *
     * @param Message $equipment
     * @return void
     */
    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Equipment Expiration Reminder!")->view('equipment.expiration.created')
            ->with([
                'equipment' => $this->equipment,
                'property' => $this->equipment->property
            ]);

    }
}
