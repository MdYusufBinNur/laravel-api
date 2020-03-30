<?php

namespace App\Mail\Announcement;

use App\DbModels\Announcement;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementCreated extends Mailable
{
    use SerializesModels;

    /**
     * @var Announcement
     */
    public $announcement;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Announcement $announcement
     * @param User $user
     */
    public function __construct(Announcement $announcement, User $user)
    {
        $this->announcement = $announcement;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $property = $this->announcement->property;

        return $this->subject("An Announcement from " . $property->title)->view('announcement.created.index')
            ->with(['announcement' => $this->announcement, 'user' => $this->user, 'property' => $property]);
    }
}
