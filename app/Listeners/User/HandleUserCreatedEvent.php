<?php

namespace App\Listeners\User;

use App\Events\User\UserCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\User\ResetUserPassword;
use App\Repositories\Contracts\PasswordResetRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleUserCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserCreatedEvent  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $user = $event->user;
        $eventOptions = $event->options;

        // send reset password email
        $passwordResetRepository = app(PasswordResetRepository::class);
        $passwordResetRepository->save(['emailOrPhone' => $user->email ?? $user->phone]);
    }
}
