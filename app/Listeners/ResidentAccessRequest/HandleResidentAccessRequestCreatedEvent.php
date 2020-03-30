<?php

namespace App\Listeners\ResidentAccessRequest;

use App\DbModels\Role;
use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestCreated;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleResidentAccessRequestCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ResidentAccessRequestCreatedEvent $event
     * @return void
     */
    public function handle(ResidentAccessRequestCreatedEvent $event)
    {
        $residentAccessRequest = $event->residentAccessRequest;
        $eventOptions = $event->options;

        $userRepository = app (UserRepository::class);
        $roleIds = [
            Role::ROLE_STAFF_PRIORITY['id'],
            Role::ROLE_STAFF_STANDARD['id']
        ];

        $toUsers = $userRepository->findBy(['propertyId' => $residentAccessRequest->propertyId, 'roleId' => $roleIds]);

        /* sending mail to staff of the property */
        foreach ($toUsers as $user) {
            Mail::to($user->email)->send(new ResidentAccessRequestCreated($residentAccessRequest, $toStaff = true));
        }

        /* Sending mail to request user */
        Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestCreated($residentAccessRequest));
    }
}
