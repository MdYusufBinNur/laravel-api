<?php

namespace App\Providers;

use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\Fdi\FdiUpdatedEvent;
use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Events\Manager\ManagerCreatedEvent;
use App\Events\Message\MessageCreatedEvent;
use App\Events\Package\PackageCreatedEvent;
use App\Events\Package\PackageUpdatedEvent;
use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Events\ParkingPass\ParkingPassCreatedEvent;
use App\Events\ParkingPass\ParkingPassUpdatedEvent;
use App\Events\PasswordReset\PasswordResetEvent;
use App\Events\Post\PostUpdatedEvent;
use App\Events\PostComment\PostCommentCreatedEvent;
use App\Events\PostComment\PostCommentDeletedEvent;
use App\Events\PostComment\PostCommentUpdatedEvent;
use App\Events\Attachment\AttachmentCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Events\Resident\ResidentCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Events\ServiceRequestMessage\ServiceRequestMessageCreatedEvent;
use App\Events\User\UserLoggedInEvent;
use App\Events\Visitor\VisitorCreatedEvent;
use App\Listeners\Fdi\HandleFdiCreatedEvent;
use App\Listeners\Fdi\HandleFdiUpdatedEvent;
use App\Listeners\InventoryItem\HandleInventoryItemCreatedEvent;
use App\Listeners\InventoryItem\HandleInventoryItemUpdatedEvent;
use App\Listeners\Message\HandleMessageCreatedEvent;
use App\Listeners\PackageArchive\HandlePackageArchivedCreatedEvent;
use App\Listeners\ParkingPass\HandleParkingPassCreatedEvent;
use App\Listeners\ParkingPass\HandleParkingPassUpdatedEvent;
use App\Listeners\PasswordReset\HandlePasswordResetEvent;
use App\Listeners\Post\HandlePostCommentUpdatedEvent;
use App\Listeners\Post\HandlePostUpdatedEvent;
use App\Listeners\PostComment\HandlePostCommentCreatedEvent;
use App\Listeners\PostComment\HandlePostCommentDeletedEvent;
use App\Listeners\Attachment\HandleAttachmentCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestUpdatedEvent;
use App\Listeners\Resident\HandleResidentCreatedEvent;
use App\Listeners\EnterpriseUser\HandleEnterpriseUserCreatedEvent;
use App\Listeners\Manager\HandleManagerCreatedEvent;
use App\Listeners\Package\HandlePackageCreatedEvent;
use App\Listeners\Package\HandlePackageUpdatedEvent;
use App\Listeners\ServiceRequest\HandleServiceRequestCreatedEvent;
use App\Listeners\ServiceRequest\HandleServiceRequestUpdatedEvent;
use App\Listeners\ServiceRequestMessage\HandleServiceRequestMessageCreatedEvent;
use App\Listeners\User\HandleUserLoggedInEvent;
use App\Listeners\Visitor\HandleVisitorCreatedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ResidentCreatedEvent::class => [
            HandleResidentCreatedEvent::class,
        ],
        ResidentAccessRequestCreatedEvent::class => [
            HandleResidentAccessRequestCreatedEvent::class,
        ],

        ResidentAccessRequestUpdatedEvent::class => [
            HandleResidentAccessRequestUpdatedEvent::class,
        ],
        ManagerCreatedEvent::class => [
            HandleManagerCreatedEvent::class
        ],
        EnterpriseUserCreatedEvent::class => [
            HandleEnterpriseUserCreatedEvent::class
        ],
        ServiceRequestUpdatedEvent::class => [
            HandleServiceRequestUpdatedEvent::class
        ],
        ServiceRequestCreatedEvent::class => [
            HandleServiceRequestCreatedEvent::class
        ],
        ServiceRequestMessageCreatedEvent::class => [
            HandleServiceRequestMessageCreatedEvent::class
        ],
        FdiCreatedEvent::class => [
            HandleFdiCreatedEvent::class
        ],
        FdiUpdatedEvent::class => [
            HandleFdiUpdatedEvent::class
        ],
        PackageCreatedEvent::class => [
            HandlePackageCreatedEvent::class
        ],
        PackageUpdatedEvent::class => [
            HandlePackageUpdatedEvent::class
        ],
        PackageArchivedCreatedEvent::class => [
            HandlePackageArchivedCreatedEvent::class
        ],
        VisitorCreatedEvent::class => [
            HandleVisitorCreatedEvent::class
        ],
        PostUpdatedEvent::class => [
            HandlePostUpdatedEvent::class
        ],
        MessageCreatedEvent::class => [
            HandleMessageCreatedEvent::class
        ],
        ParkingPassCreatedEvent::class => [
            HandleParkingPassCreatedEvent::class
        ],
        ParkingPassUpdatedEvent::class => [
            HandleParkingPassUpdatedEvent::class
        ],
        UserLoggedInEvent::class => [
            HandleUserLoggedInEvent::class
        ],
        PasswordResetEvent::class => [
            HandlePasswordResetEvent::class
        ],
        PostCommentCreatedEvent::class => [
            HandlePostCommentCreatedEvent::class
        ],
        PostCommentUpdatedEvent::class => [
            HandlePostCommentUpdatedEvent::class
        ],
        PostCommentDeletedEvent::class => [
            HandlePostCommentDeletedEvent::class
        ],
        InventoryItemCreatedEvent::class => [
            HandleInventoryItemCreatedEvent::class
        ],
        InventoryItemUpdatedEvent::class => [
            HandleInventoryItemUpdatedEvent::class
        ],
        AttachmentCreatedEvent::class => [
            HandleAttachmentCreatedEvent::class
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
