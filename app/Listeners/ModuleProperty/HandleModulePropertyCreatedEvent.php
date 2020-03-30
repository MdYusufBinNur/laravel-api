<?php

namespace App\Listeners\ModuleProperty;

use App\DbModels\Role;
use App\Events\ModuleProperty\ModulePropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\ModuleProperty\ModulePropertyUpdated;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleModulePropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModulePropertyCreatedEvent  $event
     * @return void
     */
    public function handle(ModulePropertyCreatedEvent $event)
    {
        $moduleProperty = $event->moduleProperty;
        $eventOptions = $event->options;

        $userRepository = app (UserRepository::class);
        $roleIds = [
                        Role::ROLE_ENTERPRISE_ADMIN['id'],
                        Role::ROLE_ENTERPRISE_STANDARD['id'],
                        Role::ROLE_STAFF_PRIORITY['id'],
                        Role::ROLE_STAFF_STANDARD['id'],
                        Role::ROLE_STAFF_LIMITED['id']
                    ];

        $toUsers = $userRepository->findBy(['propertyId' => $moduleProperty->propertyId, 'roleId' => $roleIds]);

        foreach ($toUsers as $user) {
            Mail::to($user->email)->send(new ModulePropertyUpdated($moduleProperty, $user));
        }
    }
}
