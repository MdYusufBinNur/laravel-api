<?php

namespace App\Mail\Reminder;

use App\DbModels\Reminder;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminder extends Mailable
{
    use SerializesModels;
    /**
     * @var Reminder
     */
    public $reminder;

    /**
     * Create a new message instance.
     *
     * @param Reminder $reminder
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reminder = $this->reminder;
        $property = $this->reminder->property;

        return $this->subject("Reminder from {$property->title} community")->view('reminder.index')
            ->with(['reminder' => $reminder, 'property' => $property]);
    }
}
