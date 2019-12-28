<?php

namespace App\Mail\Message;

use App\DbModels\Message;
use App\DbModels\Property;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessageNotification extends Mailable
{
    use SerializesModels;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var Property
     */
    public $property;

    /**
     * @var User
     */
    public $fromUser;

    /**
     * @var User
     */
    public $toUser;

    /**
     * @var string
     */
    public $messageText;

    /**
     * Create a new message instance.
     *
     * @param Message $message
     * @param Property $property
     * @param User $fromUser
     * @param User $toUser
     * @param string $messageText
     * @return void
     */
    public function __construct(Message $message, Property $property, User $fromUser, User $toUser, string $messageText)
    {
        $this->message = $message;
        $this->property = $property;
        $this->fromUser = $fromUser;
        $this->toUser = $toUser;
        $this->messageText = $messageText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Message!")->view('message.notification.created')
            ->with([
                'messageModel' => $this->message, //message property is restricted in blade
                'property' => $this->property,
                'fromUser' => $this->fromUser,
                'toUser' => $this->toUser,
                'messageText' => $this->messageText,
            ]);

    }
}
