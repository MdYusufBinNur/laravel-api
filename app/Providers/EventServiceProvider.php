<?php

namespace App\Providers;

use App\Events\Admin\AdminCreatedEvent;
use App\Events\Admin\AdminUpdatedEvent;
use App\Events\Announcement\AnnouncementCreatedEvent;
use App\Events\Announcement\AnnouncementUpdatedEvent;
use App\Events\Company\CompanyCreatedEvent;
use App\Events\Company\CompanyUpdatedEvent;
use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Events\EnterpriseUserProperty\EnterpriseUserPropertyCreatedEvent;
use App\Events\EnterpriseUserProperty\EnterpriseUserPropertyUpdatedEvent;
use App\Events\Equipment\EquipmentCreatedEvent;
use App\Events\Equipment\EquipmentUpdatedEvent;
use App\Events\Event\EventCreatedEvent;
use App\Events\Event\EventUpdatedEvent;
use App\Events\EventSignup\EventSignupCreatedEvent;
use App\Events\EventSignup\EventSignupUpdatedEvent;
use App\Events\Expense\ExpenseCreatedEvent;
use App\Events\Expense\ExpenseUpdatedEvent;
use App\Events\ExpenseCategory\ExpenseCategoryCreatedEvent;
use App\Events\ExpenseCategory\ExpenseCategoryUpdatedEvent;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\Fdi\FdiUpdatedEvent;
use App\Events\FdiGuestType\FdiGuestTypeCreatedEvent;
use App\Events\FdiGuestType\FdiGuestTypeUpdatedEvent;
use App\Events\FdiLog\FdiLogCreatedEvent;
use App\Events\FdiLog\FdiLogUpdatedEvent;
use App\Events\Feedback\FeedbackCreatedEvent;
use App\Events\Feedback\FeedbackDeletedEvent;
use App\Events\Income\IncomeCreatedEvent;
use App\Events\Income\IncomeUpdatedEvent;
use App\Events\IncomeCategory\IncomeCategoryCreatedEvent;
use App\Events\IncomeCategory\IncomeCategoryUpdatedEvent;
use App\Events\InventoryCategory\InventoryCategoryCreatedEvent;
use App\Events\InventoryCategory\InventoryCategoryUpdatedEvent;
use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Events\InventoryItemLog\InventoryItemLogCreatedEvent;
use App\Events\LdsBlacklistUnit\LdsBlacklistUnitCreatedEvent;
use App\Events\LdsBlacklistUnit\LdsBlacklistUnitUpdatedEvent;
use App\Events\LdsSetting\LdsSettingCreatedEvent;
use App\Events\LdsSetting\LdsSettingUpdatedEvent;
use App\Events\LdsSlide\LdsSlideCreatedEvent;
use App\Events\LdsSlide\LdsSlideUpdatedEvent;
use App\Events\LdsSlideProperty\LdsSlidePropertyCreatedEvent;
use App\Events\LdsSlideProperty\LdsSlidePropertyUpdatedEvent;
use App\Events\Manager\ManagerCreatedEvent;
use App\Events\ManagerInvitation\ManagerInvitationCreatedEvent;
use App\Events\ManagerInvitation\ManagerInvitationUpdatedEvent;
use App\Events\Message\MessageCreatedEvent;
use App\Events\MessagePost\MessagePostCreatedEvent;
use App\Events\MessagePost\MessagePostUpdatedEvent;
use App\Events\MessageTemplate\MessageTemplateCreatedEvent;
use App\Events\MessageTemplate\MessageTemplateUpdatedEvent;
use App\Events\MessageUser\MessageUserCreatedEvent;
use App\Events\MessageUser\MessageUserUpdatedEvent;
use App\Events\Module\ModuleCreatedEvent;
use App\Events\Module\ModuleUpdatedEvent;
use App\Events\ModuleOption\ModuleOptionCreatedEvent;
use App\Events\ModuleOption\ModuleOptionUpdatedEvent;
use App\Events\ModuleOptionProperty\ModuleOptionPropertyCreatedEvent;
use App\Events\ModuleOptionProperty\ModuleOptionPropertyUpdatedEvent;
use App\Events\ModuleProperty\ModulePropertyCreatedEvent;
use App\Events\ModuleProperty\ModulePropertyUpdatedEvent;
use App\Events\NotificationFeed\NotificationFeedCreatedEvent;
use App\Events\NotificationFeed\NotificationFeedUpdatedEvent;
use App\Events\NotificationTemplate\NotificationTemplateCreatedEvent;
use App\Events\NotificationTemplate\NotificationTemplateUpdatedEvent;
use App\Events\NotificationTemplateProperty\NotificationTemplatePropertyCreatedEvent;
use App\Events\NotificationTemplateProperty\NotificationTemplatePropertyUpdatedEvent;
use App\Events\NotificationTemplateType\NotificationTemplateTypeCreatedEvent;
use App\Events\NotificationTemplateType\NotificationTemplateTypeUpdatedEvent;
use App\Events\Package\PackageCreatedEvent;
use App\Events\Package\PackageUpdatedEvent;
use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Events\PackageType\PackageTypeCreatedEvent;
use App\Events\PackageType\PackageTypeUpdatedEvent;
use App\Events\ParkingPass\ParkingPassCreatedEvent;
use App\Events\ParkingPass\ParkingPassUpdatedEvent;
use App\Events\ParkingPassLog\ParkingPassLogCreatedEvent;
use App\Events\ParkingPassLog\ParkingPassLogUpdatedEvent;
use App\Events\ParkingSpace\ParkingSpaceCreatedEvent;
use App\Events\ParkingSpace\ParkingSpaceUpdatedEvent;
use App\Events\PasswordReset\PasswordResetEvent;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Events\PaymentItemLog\PaymentItemLogCreatedEvent;
use App\Events\PaymentItemLog\PaymentItemLogUpdatedEvent;
use App\Events\PaymentItemPartial\PaymentItemPartialCreatedEvent;
use App\Events\PaymentItemPartial\PaymentItemPartialDeletedEvent;
use App\Events\PaymentItemPartial\PaymentItemPartialUpdatedEvent;
use App\Events\PaymentMethod\PaymentMethodCreatedEvent;
use App\Events\PaymentMethod\PaymentMethodUpdatedEvent;
use App\Events\PaymentType\PaymentTypeCreatedEvent;
use App\Events\PaymentType\PaymentTypeUpdatedEvent;
use App\Events\Post\PostUpdatedEvent;
use App\Events\PostApprovalArchive\PostApprovalArchiveCreatedEvent;
use App\Events\PostApprovalArchive\PostApprovalArchiveUpdatedEvent;
use App\Events\PostApprovalBlacklistUnit\PostApprovalBlacklistUnitCreatedEvent;
use App\Events\PostApprovalBlacklistUnit\PostApprovalBlacklistUnitUpdatedEvent;
use App\Events\PostComment\PostCommentCreatedEvent;
use App\Events\PostComment\PostCommentDeletedEvent;
use App\Events\PostComment\PostCommentUpdatedEvent;
use App\Events\Attachment\AttachmentCreatedEvent;
use App\Events\PostEvent\PostEventCreatedEvent;
use App\Events\PostEvent\PostEventUpdatedEvent;
use App\Events\PostMarketPlace\PostMarketPlaceCreatedEvent;
use App\Events\PostMarketPlace\PostMarketPlaceUpdatedEvent;
use App\Events\PostPoll\PostPollCreatedEvent;
use App\Events\PostPoll\PostPollUpdatedEvent;
use App\Events\PostRecommendation\PostRecommendationCreatedEvent;
use App\Events\PostRecommendation\PostRecommendationUpdatedEvent;
use App\Events\PostRecommendationType\PostRecommendationTypeCreatedEvent;
use App\Events\PostRecommendationType\PostRecommendationTypeUpdatedEvent;
use App\Events\PostWall\PostWallCreatedEvent;
use App\Events\PostWall\PostWallUpdatedEvent;
use App\Events\Property\PropertyCreatedEvent;
use App\Events\Property\PropertyUpdatedEvent;
use App\Events\PropertyDesignSetting\PropertyDesignSettingCreatedEvent;
use App\Events\PropertyDesignSetting\PropertyDesignSettingUpdatedEvent;
use App\Events\PropertyGeneralInfo\PropertyGeneralInfoCreatedEvent;
use App\Events\PropertyGeneralInfo\PropertyGeneralInfoUpdatedEvent;
use App\Events\PropertyImage\PropertyImageCreatedEvent;
use App\Events\PropertyImage\PropertyImageUpdatedEvent;
use App\Events\PropertyLink\PropertyLinkCreatedEvent;
use App\Events\PropertyLink\PropertyLinkUpdatedEvent;
use App\Events\PropertyLinkCategory\PropertyLinkCategoryCreatedEvent;
use App\Events\PropertyLinkCategory\PropertyLinkCategoryUpdatedEvent;
use App\Events\PropertySocialMedia\PropertySocialMediaCreatedEvent;
use App\Events\PropertySocialMedia\PropertySocialMediaUpdatedEvent;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Events\Resident\ResidentCreatedEvent;
use App\Events\ResidentArchive\ResidentArchiveCreatedEvent;
use App\Events\ResidentArchive\ResidentArchiveUpdatedEvent;
use App\Events\ResidentEmergency\ResidentEmergencyCreatedEvent;
use App\Events\ResidentEmergency\ResidentEmergencyUpdatedEvent;
use App\Events\ResidentVehicle\ResidentVehicleCreatedEvent;
use App\Events\ResidentVehicle\ResidentVehicleUpdatedEvent;
use App\Events\Role\RoleCreatedEvent;
use App\Events\Role\RoleUpdatedEvent;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Events\ServiceRequestCategory\ServiceRequestCategoryCreatedEvent;
use App\Events\ServiceRequestCategory\ServiceRequestCategoryUpdatedEvent;
use App\Events\ServiceRequestLog\ServiceRequestLogCreatedEvent;
use App\Events\ServiceRequestLog\ServiceRequestLogUpdatedEvent;
use App\Events\ServiceRequestMessage\ServiceRequestMessageCreatedEvent;
use App\Events\ServiceRequestOfficeDetail\ServiceRequestOfficeDetailCreatedEvent;
use App\Events\ServiceRequestOfficeDetail\ServiceRequestOfficeDetailUpdatedEvent;
use App\Events\Staff\StaffCreatedEvent;
use App\Events\Staff\StaffUpdatedEvent;
use App\Events\Tower\TowerCreatedEvent;
use App\Events\Tower\TowerUpdatedEvent;
use App\Events\Unit\UnitCreatedEvent;
use App\Events\Unit\UnitUpdatedEvent;
use App\Events\User\UserCreatedEvent;
use App\Events\User\UserLoggedInEvent;
use App\Events\User\UserUpdatedEvent;
use App\Events\UserNotification\UserNotificationCreatedEvent;
use App\Events\UserNotification\UserNotificationUpdatedEvent;
use App\Events\UserNotificationSetting\UserNotificationSettingCreatedEvent;
use App\Events\UserNotificationSetting\UserNotificationSettingUpdatedEvent;
use App\Events\UserNotificationType\UserNotificationTypeCreatedEvent;
use App\Events\UserNotificationType\UserNotificationTypeUpdatedEvent;
use App\Events\UserProfile\UserProfileCreatedEvent;
use App\Events\UserProfile\UserProfileUpdatedEvent;
use App\Events\UserProfileChild\UserProfileChildCreatedEvent;
use App\Events\UserProfileChild\UserProfileChildUpdatedEvent;
use App\Events\UserProfileLink\UserProfileLinkCreatedEvent;
use App\Events\UserProfileLink\UserProfileLinkUpdatedEvent;
use App\Events\UserProfilePost\UserProfilePostCreatedEvent;
use App\Events\UserProfilePost\UserProfilePostUpdatedEvent;
use App\Events\UserPropertyManager\UserPropertyManagerCreatedEvent;
use App\Events\UserPropertyManager\UserPropertyManagerUpdatedEvent;
use App\Events\UserPropertyResident\UserPropertyResidentCreatedEvent;
use App\Events\UserPropertyResident\UserPropertyResidentUpdatedEvent;
use App\Events\UserRole\UserRoleCreatedEvent;
use App\Events\UserRole\UserRoleUpdatedEvent;
use App\Events\Visitor\VisitorCreatedEvent;
use App\Events\Visitor\VisitorUpdatedEvent;
use App\Events\VisitorArchive\VisitorArchiveCreatedEvent;
use App\Events\VisitorArchive\VisitorArchiveUpdatedEvent;
use App\Events\VisitorType\VisitorTypeCreatedEvent;
use App\Events\VisitorType\VisitorTypeUpdatedEvent;
use App\Listeners\Admin\HandleAdminCreatedEvent;
use App\Listeners\Admin\HandleAdminUpdatedEvent;
use App\Listeners\Announcement\HandleAnnouncementCreatedEvent;
use App\Listeners\Announcement\HandleAnnouncementUpdatedEvent;
use App\Listeners\Company\HandleCompanyCreatedEvent;
use App\Listeners\Company\HandleCompanyUpdatedEvent;
use App\Listeners\EnterpriseUserProperty\HandleEnterpriseUserPropertyCreatedEvent;
use App\Listeners\EnterpriseUserProperty\HandleEnterpriseUserPropertyUpdatedEvent;
use App\Listeners\Equipment\HandleEquipmentCreatedEvent;
use App\Listeners\Equipment\HandleEquipmentUpdatedEvent;
use App\Listeners\Event\HandleEventCreatedEvent;
use App\Listeners\Event\HandleEventUpdatedEvent;
use App\Listeners\EventSignup\HandleEventSignupCreatedEvent;
use App\Listeners\EventSignup\HandleEventSignupUpdatedEvent;
use App\Listeners\Expense\HandleExpenseCreatedEvent;
use App\Listeners\Expense\HandleExpenseUpdatedEvent;
use App\Listeners\ExpenseCategory\HandleExpenseCategoryCreatedEvent;
use App\Listeners\ExpenseCategory\HandleExpenseCategoryUpdatedEvent;
use App\Listeners\Fdi\HandleFdiCreatedEvent;
use App\Listeners\Fdi\HandleFdiUpdatedEvent;
use App\Listeners\FdiGuestType\HandleFdiGuestTypeCreatedEvent;
use App\Listeners\FdiGuestType\HandleFdiGuestTypeUpdatedEvent;
use App\Listeners\FdiLog\HandleFdiLogCreatedEvent;
use App\Listeners\FdiLog\HandleFdiLogUpdatedEvent;
use App\Listeners\Feedback\HandleFeedbackCreatedEvent;
use App\Listeners\Feedback\HandleFeedbackDeletedEvent;
use App\Listeners\Income\HandleIncomeCreatedEvent;
use App\Listeners\Income\HandleIncomeUpdatedEvent;
use App\Listeners\IncomeCategory\HandleIncomeCategoryCreatedEvent;
use App\Listeners\IncomeCategory\HandleIncomeCategoryUpdatedEvent;
use App\Listeners\InventoryCategory\HandleInventoryCategoryUpdatedEvent;
use App\Listeners\InventoryItem\HandleInventoryItemCreatedEvent;
use App\Listeners\InventoryItem\HandleInventoryItemUpdatedEvent;
use App\Listeners\InventoryItemLog\HandleInventoryItemLogCreatedEvent;
use App\Listeners\LdsBlacklistUnit\HandleLdsBlacklistUnitCreatedEvent;
use App\Listeners\LdsBlacklistUnit\HandleLdsBlacklistUnitUpdatedEvent;
use App\Listeners\LdsSetting\HandleLdsSettingCreatedEvent;
use App\Listeners\LdsSetting\HandleLdsSettingUpdatedEvent;
use App\Listeners\LdsSlide\HandleLdsSlideCreatedEvent;
use App\Listeners\LdsSlide\HandleLdsSlideUpdatedEvent;
use App\Listeners\LdsSlideProperty\HandleLdsSlidePropertyCreatedEvent;
use App\Listeners\LdsSlideProperty\HandleLdsSlidePropertyUpdatedEvent;
use App\Listeners\ManagerInvitation\HandleManagerInvitationCreatedEvent;
use App\Listeners\ManagerInvitation\HandleManagerInvitationUpdatedEvent;
use App\Listeners\Message\HandleMessageCreatedEvent;
use App\Listeners\MessagePost\HandleMessagePostCreatedEvent;
use App\Listeners\MessagePost\HandleMessagePostUpdatedEvent;
use App\Listeners\MessageTemplate\HandleMessageTemplateCreatedEvent;
use App\Listeners\MessageTemplate\HandleMessageTemplateUpdatedEvent;
use App\Listeners\MessageUser\HandleMessageUserCreatedEvent;
use App\Listeners\MessageUser\HandleMessageUserUpdatedEvent;
use App\Listeners\Module\HandleModuleCreatedEvent;
use App\Listeners\Module\HandleModuleUpdatedEvent;
use App\Listeners\ModuleOption\HandleModuleOptionCreatedEvent;
use App\Listeners\ModuleOption\HandleModuleOptionUpdatedEvent;
use App\Listeners\ModuleOptionProperty\HandleModuleOptionPropertyCreatedEvent;
use App\Listeners\ModuleOptionProperty\HandleModuleOptionPropertyUpdatedEvent;
use App\Listeners\ModuleProperty\HandleModulePropertyCreatedEvent;
use App\Listeners\ModuleProperty\HandleModulePropertyUpdatedEvent;
use App\Listeners\NotificationFeed\HandleNotificationFeedCreatedEvent;
use App\Listeners\NotificationFeed\HandleNotificationFeedUpdatedEvent;
use App\Listeners\NotificationTemplate\HandleNotificationTemplateCreatedEvent;
use App\Listeners\NotificationTemplate\HandleNotificationTemplateUpdatedEvent;
use App\Listeners\NotificationTemplateProperty\HandleNotificationTemplatePropertyCreatedEvent;
use App\Listeners\NotificationTemplateProperty\HandleNotificationTemplatePropertyUpdatedEvent;
use App\Listeners\NotificationTemplateType\HandleNotificationTemplateTypeCreatedEvent;
use App\Listeners\NotificationTemplateType\HandleNotificationTemplateTypeUpdatedEvent;
use App\Listeners\PackageArchive\HandlePackageArchivedCreatedEvent;
use App\Listeners\PackageType\HandlePackageTypeCreatedEvent;
use App\Listeners\PackageType\HandlePackageTypeUpdatedEvent;
use App\Listeners\ParkingPass\HandleParkingPassCreatedEvent;
use App\Listeners\ParkingPass\HandleParkingPassUpdatedEvent;
use App\Listeners\ParkingPassLog\HandleParkingPassLogCreatedEvent;
use App\Listeners\ParkingPassLog\HandleParkingPassLogUpdatedEvent;
use App\Listeners\ParkingSpace\HandleParkingSpaceCreatedEvent;
use App\Listeners\ParkingSpace\HandleParkingSpaceUpdatedEvent;
use App\Listeners\PasswordReset\HandlePasswordResetEvent;
use App\Listeners\Payment\HandlePaymentCreatedEvent;
use App\Listeners\Payment\HandlePaymentUpdatedEvent;
use App\Listeners\PaymentItem\HandlePaymentItemCreatedEvent;
use App\Listeners\PaymentItem\HandlePaymentItemUpdatedEvent;
use App\Listeners\PaymentItemLog\HandlePaymentItemLogCreatedEvent;
use App\Listeners\PaymentItemLog\HandlePaymentItemLogUpdatedEvent;
use App\Listeners\PaymentItemPartial\HandlePaymentItemPartialCreatedEvent;
use App\Listeners\PaymentItemPartial\HandlePaymentItemPartialDeletedEvent;
use App\Listeners\PaymentItemPartial\HandlePaymentItemPartialUpdatedEvent;
use App\Listeners\PaymentMethod\HandlePaymentMethodCreatedEvent;
use App\Listeners\PaymentMethod\HandlePaymentMethodUpdatedEvent;
use App\Listeners\PaymentType\HandlePaymentTypeCreatedEvent;
use App\Listeners\PaymentType\HandlePaymentTypeUpdatedEvent;
use App\Listeners\Post\HandlePostCommentUpdatedEvent;
use App\Listeners\Post\HandlePostUpdatedEvent;
use App\Listeners\PostApprovalArchive\HandlePostApprovalArchiveCreatedEvent;
use App\Listeners\PostApprovalArchive\HandlePostApprovalArchiveUpdatedEvent;
use App\Listeners\PostApprovalBlacklistUnit\HandlePostApprovalBlacklistUnitCreatedEvent;
use App\Listeners\PostApprovalBlacklistUnit\HandlePostApprovalBlacklistUnitUpdatedEvent;
use App\Listeners\PostComment\HandlePostCommentCreatedEvent;
use App\Listeners\PostComment\HandlePostCommentDeletedEvent;
use App\Listeners\Attachment\HandleAttachmentCreatedEvent;
use App\Listeners\PostEvent\HandlePostEventCreatedEvent;
use App\Listeners\PostEvent\HandlePostEventUpdatedEvent;
use App\Listeners\PostMarketPlace\HandlePostMarketPlaceCreatedEvent;
use App\Listeners\PostMarketPlace\HandlePostMarketPlaceUpdatedEvent;
use App\Listeners\PostPoll\HandlePostPollCreatedEvent;
use App\Listeners\PostPoll\HandlePostPollUpdatedEvent;
use App\Listeners\PostRecommendation\HandlePostRecommendationCreatedEvent;
use App\Listeners\PostRecommendation\HandlePostRecommendationUpdatedEvent;
use App\Listeners\PostRecommendationType\HandlePostRecommendationTypeCreatedEvent;
use App\Listeners\PostRecommendationType\HandlePostRecommendationTypeUpdatedEvent;
use App\Listeners\PostWall\HandlePostWallCreatedEvent;
use App\Listeners\PostWall\HandlePostWallUpdatedEvent;
use App\Listeners\Property\HandlePropertyCreatedEvent;
use App\Listeners\Property\HandlePropertyUpdatedEvent;
use App\Listeners\PropertyDesignSetting\HandlePropertyDesignSettingCreatedEvent;
use App\Listeners\PropertyDesignSetting\HandlePropertyDesignSettingUpdatedEvent;
use App\Listeners\PropertyGeneralInfo\HandlePropertyGenralInfoCreatedEvent;
use App\Listeners\PropertyGeneralInfo\HandlePropertyGenralInfoUpdatedEvent;
use App\Listeners\PropertyImage\HandlePropertyImageCreatedEvent;
use App\Listeners\PropertyImage\HandlePropertyImageUpdatedEvent;
use App\Listeners\PropertyLink\HandlePropertyLinkCreatedEvent;
use App\Listeners\PropertyLink\HandlePropertyLinkUpdatedEvent;
use App\Listeners\PropertyLinkCategory\HandlePropertyLinkCategoryCreatedEvent;
use App\Listeners\PropertyLinkCategory\HandlePropertyLinkCategoryUpdatedEvent;
use App\Listeners\PropertySocialMedia\HandlePropertySocialMediaCreatedEvent;
use App\Listeners\PropertySocialMedia\HandlePropertySocialMediaUpdatedEvent;
use App\Listeners\Reminder\HandleReminderCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestUpdatedEvent;
use App\Listeners\Resident\HandleResidentCreatedEvent;
use App\Listeners\EnterpriseUser\HandleEnterpriseUserCreatedEvent;
use App\Listeners\Manager\HandleManagerCreatedEvent;
use App\Listeners\Package\HandlePackageCreatedEvent;
use App\Listeners\Package\HandlePackageUpdatedEvent;
use App\Listeners\ResidentArchive\HandleResidentArchiveCreatedEvent;
use App\Listeners\ResidentArchive\HandleResidentArchiveUpdatedEvent;
use App\Listeners\ResidentEmergency\HandleResidentEmergencyCreatedEvent;
use App\Listeners\ResidentVehicle\HandleResidentVehicleCreatedEvent;
use App\Listeners\ResidentVehicle\HandleResidentVehicleUpdatedEvent;
use App\Listeners\Role\HandleRoleCreatedEvent;
use App\Listeners\Role\HandleRoleUpdatedEvent;
use App\Listeners\ServiceRequest\HandleServiceRequestCreatedEvent;
use App\Listeners\ServiceRequest\HandleServiceRequestUpdatedEvent;
use App\Listeners\ServiceRequestCategory\HandleServiceRequestCategoryCreatedEvent;
use App\Listeners\ServiceRequestCategory\HandleServiceRequestCategoryUpdatedEvent;
use App\Listeners\ServiceRequestLog\HandleServiceRequestLogCreatedEvent;
use App\Listeners\ServiceRequestLog\HandleServiceRequestLogUpdatedEvent;
use App\Listeners\ServiceRequestMessage\HandleServiceRequestMessageCreatedEvent;
use App\Listeners\ServiceRequestOfficeDetail\HandleServiceRequestOfficeDetailCreatedEvent;
use App\Listeners\ServiceRequestOfficeDetail\HandleServiceRequestOfficeDetailUpdatedEvent;
use App\Listeners\Staff\HandleStaffCreatedEvent;
use App\Listeners\Staff\HandleStaffUpdatedEvent;
use App\Listeners\Tower\HandleTowerCreatedEvent;
use App\Listeners\Tower\HandleTowerUpdatedEvent;
use App\Listeners\Unit\HandleUnitCreatedEvent;
use App\Listeners\Unit\HandleUnitUpdatedEvent;
use App\Listeners\User\HandleUserCreatedEvent;
use App\Listeners\User\HandleUserLoggedInEvent;
use App\Listeners\User\HandleUserUpdatedEvent;
use App\Listeners\UserNotification\HandleUserNotificationCreatedEvent;
use App\Listeners\UserNotification\HandleUserNotificationUpdatedEvent;
use App\Listeners\UserNotificationType\HandleUserNotificationTypeCreatedEvent;
use App\Listeners\UserNotificationType\HandleUserNotificationTypeUpdatedEvent;
use App\Listeners\UserProfile\HandleUserProfileCreatedEvent;
use App\Listeners\UserProfile\HandleUserProfileUpdatedEvent;
use App\Listeners\UserProfileChild\HandleUserProfileChildCreatedEvent;
use App\Listeners\UserProfileChild\HandleUserProfileChildUpdatedEvent;
use App\Listeners\UserProfileLink\HandleUserProfileLinkCreatedEvent;
use App\Listeners\UserProfileLink\HandleUserProfileLinkUpdatedEvent;
use App\Listeners\UserProfilePost\HandleUserProfilePostCreatedEvent;
use App\Listeners\UserProfilePost\HandleUserProfilePostUpdatedEvent;
use App\Listeners\UserPropertyManager\HandleUserPropertyManagerCreatedEvent;
use App\Listeners\UserPropertyManager\HandleUserPropertyManagerUpdatedEvent;
use App\Listeners\UserPropertyResident\HandleUserPropertyResidentCreatedEvent;
use App\Listeners\UserPropertyResident\HandleUserPropertyResidentUpdatedEvent;
use App\Listeners\UserRole\HandleUserRoleCreatedEvent;
use App\Listeners\UserRole\HandleUserRoleUpdatedEvent;
use App\Listeners\Visitor\HandleVisitorCreatedEvent;
use App\Listeners\Visitor\HandleVisitorUpdatedEvent;
use App\Listeners\VisitorArchive\HandleVisitorArchiveCreatedEvent;
use App\Listeners\VisitorArchive\HandleVisitorArchiveUpdatedEvent;
use App\Listeners\VisitorType\HandleVisitorTypeCreatedEvent;
use App\Listeners\VisitorType\HandleVisitorTypeUpdatedEvent;
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
        AdminCreatedEvent::class => [
            HandleAdminCreatedEvent::class
        ],
        AdminUpdatedEvent::class => [
            HandleAdminUpdatedEvent::class
        ],
      
        AttachmentCreatedEvent::class => [
            HandleAttachmentCreatedEvent::class
        ],

        AnnouncementCreatedEvent::class => [
            HandleAnnouncementCreatedEvent::class
        ],
        AnnouncementUpdatedEvent::class => [
            HandleAnnouncementUpdatedEvent::class
        ],

        CompanyCreatedEvent::class => [
            HandleCompanyCreatedEvent::class
        ],
        CompanyUpdatedEvent::class => [
            HandleCompanyUpdatedEvent::class
        ],

        EnterpriseUserCreatedEvent::class => [
            HandleEnterpriseUserCreatedEvent::class
        ],
        EnterpriseUserPropertyCreatedEvent::class => [
            HandleEnterpriseUserPropertyCreatedEvent::class
        ],
        EnterpriseUserPropertyUpdatedEvent::class => [
            HandleEnterpriseUserPropertyUpdatedEvent::class
        ],

        EquipmentCreatedEvent::class => [
            HandleEquipmentCreatedEvent::class
        ],
        EquipmentUpdatedEvent::class => [
            HandleEquipmentUpdatedEvent::class
        ],

        EventCreatedEvent::class => [
            HandleEventCreatedEvent::class
        ],
        EventUpdatedEvent::class => [
            HandleEventUpdatedEvent::class
        ],
        EventSignupCreatedEvent::class => [
            HandleEventSignupCreatedEvent::class
        ],
        EventSignupUpdatedEvent::class => [
            HandleEventSignupUpdatedEvent::class
        ],
        ExpenseCreatedEvent::class => [
            HandleExpenseCreatedEvent::class
        ],
        ExpenseUpdatedEvent::class => [
            HandleExpenseUpdatedEvent::class
        ],
        ExpenseCategoryCreatedEvent::class => [
            HandleExpenseCategoryCreatedEvent::class
        ],
        ExpenseCategoryUpdatedEvent::class => [
            HandleExpenseCategoryUpdatedEvent::class
        ],

        FeedbackCreatedEvent::class => [
            HandleFeedbackCreatedEvent::class
        ],
        FeedbackDeletedEvent::class => [
            HandleFeedbackDeletedEvent::class
        ],

        FdiCreatedEvent::class => [
            HandleFdiCreatedEvent::class
        ],
        FdiUpdatedEvent::class => [
            HandleFdiUpdatedEvent::class
        ],
        FdiGuestTypeCreatedEvent::class => [
            HandleFdiGuestTypeCreatedEvent::class
        ],
        FdiGuestTypeUpdatedEvent::class => [
            HandleFdiGuestTypeUpdatedEvent::class
        ],
        FdiLogCreatedEvent::class => [
            HandleFdiLogCreatedEvent::class
        ],
        FdiLogUpdatedEvent::class => [
            HandleFdiLogUpdatedEvent::class
        ],

        IncomeCreatedEvent::class => [
            HandleIncomeCreatedEvent::class
        ],
        IncomeUpdatedEvent::class => [
            HandleIncomeUpdatedEvent::class
        ],
        IncomeCategoryCreatedEvent::class => [
            HandleIncomeCategoryCreatedEvent::class
        ],
        IncomeCategoryUpdatedEvent::class => [
            HandleIncomeCategoryUpdatedEvent::class
        ],

        InventoryCategoryCreatedEvent::class => [
            HandleIncomeCategoryCreatedEvent::class
        ],
        InventoryCategoryUpdatedEvent::class => [
            HandleInventoryCategoryUpdatedEvent::class
        ],
        InventoryItemCreatedEvent::class => [
            HandleInventoryItemCreatedEvent::class
        ],
        InventoryItemUpdatedEvent::class => [
            HandleInventoryItemUpdatedEvent::class
        ],
        InventoryItemLogCreatedEvent::class => [
            HandleInventoryItemLogCreatedEvent::class
        ],

        LdsBlacklistUnitCreatedEvent::class => [
            HandleLdsBlacklistUnitCreatedEvent::class
        ],
        LdsBlacklistUnitUpdatedEvent::class => [
            HandleLdsBlacklistUnitUpdatedEvent::class
        ],
        LdsSettingCreatedEvent::class => [
            HandleLdsSettingCreatedEvent::class
        ],
        LdsSettingUpdatedEvent::class => [
            HandleLdsSettingUpdatedEvent::class
        ],
        LdsSlideCreatedEvent::class => [
            HandleLdsSlideCreatedEvent::class
        ],
        LdsSlideUpdatedEvent::class => [
            HandleLdsSlideUpdatedEvent::class
        ],
        LdsSlidePropertyCreatedEvent::class => [
            HandleLdsSlidePropertyCreatedEvent::class
        ],
        LdsSlidePropertyUpdatedEvent::class => [
            HandleLdsSlidePropertyUpdatedEvent::class
        ],

        ManagerCreatedEvent::class => [
            HandleManagerCreatedEvent::class
        ],
        ManagerInvitationCreatedEvent::class => [
            HandleManagerInvitationCreatedEvent::class
        ],
        ManagerInvitationUpdatedEvent::class => [
            HandleManagerInvitationUpdatedEvent::class
        ],


        MessageCreatedEvent::class => [
            HandleMessageCreatedEvent::class
        ],
        MessagePostCreatedEvent::class => [
            HandleMessagePostCreatedEvent::class
        ],
        MessagePostUpdatedEvent::class => [
            HandleMessagePostUpdatedEvent::class
        ],
        MessageTemplateCreatedEvent::class => [
            HandleMessageTemplateCreatedEvent::class
        ],
        MessageTemplateUpdatedEvent::class => [
            HandleMessageTemplateUpdatedEvent::class
        ],
        MessageUserCreatedEvent::class => [
            HandleMessageUserCreatedEvent::class
        ],
        MessageUserUpdatedEvent::class => [
            HandleMessageUserUpdatedEvent::class
        ],

        ModuleCreatedEvent::class => [
            HandleModuleCreatedEvent::class
        ],
        ModuleUpdatedEvent::class => [
            HandleModuleUpdatedEvent::class
        ],
        ModuleOptionCreatedEvent::class => [
            HandleModuleOptionCreatedEvent::class
        ],
        ModuleOptionUpdatedEvent::class => [
            HandleModuleOptionUpdatedEvent::class
        ],
        ModuleOptionPropertyCreatedEvent::class =>[
            HandleModuleOptionPropertyCreatedEvent::class
        ],
        ModuleOptionPropertyUpdatedEvent::class => [
            HandleModuleOptionPropertyUpdatedEvent::class
        ],
        ModulePropertyCreatedEvent::class => [
            HandleModulePropertyCreatedEvent::class
        ],
        ModulePropertyUpdatedEvent::class => [
            HandleModulePropertyUpdatedEvent::class
        ],

        NotificationFeedCreatedEvent::class => [
            HandleNotificationFeedCreatedEvent::class
        ],
        NotificationFeedUpdatedEvent::class => [
            HandleNotificationFeedUpdatedEvent::class
        ],
        NotificationTemplateCreatedEvent::class => [
            HandleNotificationTemplateCreatedEvent::class
        ],
        NotificationTemplateUpdatedEvent::class => [
            HandleNotificationTemplateUpdatedEvent::class
        ],
        NotificationTemplatePropertyCreatedEvent::class => [
            HandleNotificationTemplatePropertyCreatedEvent::class
        ],
        NotificationTemplatePropertyUpdatedEvent::class => [
            HandleNotificationTemplatePropertyUpdatedEvent::class
        ],
        NotificationTemplateTypeCreatedEvent::class => [
            HandleNotificationTemplateTypeCreatedEvent::class
        ],
        NotificationTemplateTypeUpdatedEvent::class => [
            HandleNotificationTemplateTypeUpdatedEvent::class
        ],
        PasswordResetEvent::class => [
            HandlePasswordResetEvent::class
        ],
        PackageTypeCreatedEvent::class => [
            HandlePackageTypeCreatedEvent::class
        ],
        PackageTypeUpdatedEvent::class => [
            HandlePackageTypeUpdatedEvent::class
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
        ParkingPassCreatedEvent::class => [
            HandleParkingPassCreatedEvent::class
        ],
        ParkingPassUpdatedEvent::class => [
            HandleParkingPassUpdatedEvent::class
        ],
        ParkingPassLogCreatedEvent::class => [
            HandleParkingPassLogCreatedEvent::class
        ],
        ParkingPassLogUpdatedEvent::class => [
            HandleParkingPassLogUpdatedEvent::class
        ],
        ParkingSpaceCreatedEvent::class => [
            HandleParkingSpaceCreatedEvent::class
        ],
        ParkingSpaceUpdatedEvent::class => [
            HandleParkingSpaceUpdatedEvent::class
        ],
        PaymentMethodCreatedEvent::class => [
            HandlePaymentMethodCreatedEvent::class
        ],
        PaymentMethodUpdatedEvent::class => [
            HandlePaymentMethodUpdatedEvent::class
        ],
        PaymentTypeCreatedEvent::class => [
            HandlePaymentTypeCreatedEvent::class
        ],
        PaymentTypeUpdatedEvent::class => [
            HandlePaymentTypeUpdatedEvent::class
        ],
        PaymentCreatedEvent::class => [
            HandlePaymentCreatedEvent::class
        ],
        PaymentUpdatedEvent::class => [
            HandlePaymentUpdatedEvent::class
        ],
        PaymentItemCreatedEvent::class => [
            HandlePaymentItemCreatedEvent::class
        ],
        PaymentItemUpdatedEvent::class => [
            HandlePaymentItemUpdatedEvent::class
        ],
        PaymentItemPartialCreatedEvent::class => [
            HandlePaymentItemPartialCreatedEvent::class
        ],
        PaymentItemPartialUpdatedEvent::class => [
            HandlePaymentItemPartialUpdatedEvent::class
        ],
        PaymentItemPartialDeletedEvent::class => [
            HandlePaymentItemPartialDeletedEvent::class
        ],
        PaymentItemLogCreatedEvent::class => [
            HandlePaymentItemLogCreatedEvent::class
        ],
        PaymentItemLogUpdatedEvent::class => [
            HandlePaymentItemLogUpdatedEvent::class
        ],
        PostUpdatedEvent::class => [
            HandlePostUpdatedEvent::class
        ],
        PostApprovalArchiveCreatedEvent::class => [
            HandlePostApprovalArchiveCreatedEvent::class
        ],
        PostApprovalArchiveUpdatedEvent::class => [
            HandlePostApprovalArchiveUpdatedEvent::class
        ],
        PostApprovalBlacklistUnitCreatedEvent::class => [
            HandlePostApprovalBlacklistUnitCreatedEvent::class
        ],
        PostApprovalBlacklistUnitUpdatedEvent::class => [
            HandlePostApprovalBlacklistUnitUpdatedEvent::class
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
        PostEventCreatedEvent::class => [
            HandlePostEventCreatedEvent::class
        ],
        PostEventUpdatedEvent::class => [
            HandlePostEventUpdatedEvent::class
        ],
        PostMarketPlaceCreatedEvent::class => [
            HandlePostMarketPlaceCreatedEvent::class
        ],
        PostMarketPlaceUpdatedEvent::class => [
            HandlePostMarketPlaceUpdatedEvent::class
        ],
        PostPollCreatedEvent::class => [
            HandlePostPollCreatedEvent::class
        ],
        PostPollUpdatedEvent::class => [
            HandlePostPollUpdatedEvent::class
        ],
        PostRecommendationCreatedEvent::class => [
            HandlePostRecommendationCreatedEvent::class
        ],
        PostRecommendationUpdatedEvent::class => [
            HandlePostRecommendationUpdatedEvent::class
        ],
        PostRecommendationTypeCreatedEvent::class => [
            HandlePostRecommendationTypeCreatedEvent::class
        ],
        PostRecommendationTypeUpdatedEvent::class => [
            HandlePostRecommendationTypeUpdatedEvent::class
        ],
        PostWallCreatedEvent::class => [
            HandlePostWallCreatedEvent::class
        ],
        PostWallUpdatedEvent::class => [
            HandlePostWallUpdatedEvent::class
        ],

        PropertyCreatedEvent::class => [
            HandlePropertyCreatedEvent::class
        ],
        PropertyUpdatedEvent::class => [
            HandlePropertyUpdatedEvent::class
        ],
        PropertyDesignSettingCreatedEvent::class => [
            HandlePropertyDesignSettingCreatedEvent::class
        ],
        PropertyDesignSettingUpdatedEvent::class => [
            HandlePropertyDesignSettingUpdatedEvent::class
        ],
        PropertyGeneralInfoCreatedEvent::class => [
            HandlePropertyGenralInfoCreatedEvent::class
        ],
        PropertyGeneralInfoUpdatedEvent::class => [
            HandlePropertyGenralInfoUpdatedEvent::class
        ],
        PropertyImageCreatedEvent::class => [
            HandlePropertyImageCreatedEvent::class
        ],
        PropertyImageUpdatedEvent::class => [
            HandlePropertyImageUpdatedEvent::class
        ],
        PropertyLinkCreatedEvent::class => [
            HandlePropertyLinkCreatedEvent::class
        ],
        PropertyLinkUpdatedEvent::class => [
            HandlePropertyLinkUpdatedEvent::class
        ],
        PropertyLinkCategoryCreatedEvent::class => [
            HandlePropertyLinkCategoryCreatedEvent::class
        ],
        PropertyLinkCategoryUpdatedEvent::class => [
            HandlePropertyLinkCategoryUpdatedEvent::class
        ],
        PropertySocialMediaCreatedEvent::class => [
            HandlePropertySocialMediaCreatedEvent::class
        ],
        PropertySocialMediaUpdatedEvent::class => [
            HandlePropertySocialMediaUpdatedEvent::class
        ],


        ResidentCreatedEvent::class => [
            HandleResidentCreatedEvent::class,
        ],
        ResidentAccessRequestCreatedEvent::class => [
            HandleResidentAccessRequestCreatedEvent::class,
        ],
        ResidentAccessRequestUpdatedEvent::class => [
            HandleResidentAccessRequestUpdatedEvent::class,
        ],
        ResidentArchiveCreatedEvent::class => [
            HandleResidentArchiveCreatedEvent::class
        ],
        ResidentArchiveUpdatedEvent::class => [
            HandleResidentArchiveUpdatedEvent::class
        ],
        ResidentEmergencyCreatedEvent::class => [
            HandleResidentEmergencyCreatedEvent::class
        ],
        ResidentEmergencyUpdatedEvent::class => [
            ResidentEmergencyUpdatedEvent::class
        ],
        ResidentVehicleCreatedEvent::class => [
            HandleResidentVehicleCreatedEvent::class
        ],
        ResidentVehicleUpdatedEvent::class => [
            HandleResidentVehicleUpdatedEvent::class
        ],

        RoleCreatedEvent::class => [
            HandleRoleCreatedEvent::class
        ],
        RoleUpdatedEvent::class => [
            HandleRoleUpdatedEvent::class
        ],

        ReminderCreatedEvent::class => [
            HandleReminderCreatedEvent::class
        ],

        ServiceRequestCreatedEvent::class => [
            HandleServiceRequestCreatedEvent::class
        ],
        ServiceRequestUpdatedEvent::class => [
            HandleServiceRequestUpdatedEvent::class
        ],
        ServiceRequestCategoryCreatedEvent::class => [
            HandleServiceRequestCategoryCreatedEvent::class
        ],
        ServiceRequestLogCreatedEvent::class => [
            HandleServiceRequestLogCreatedEvent::class
        ],
        ServiceRequestLogUpdatedEvent::class => [
            HandleServiceRequestLogUpdatedEvent::class
        ],
        ServiceRequestCategoryUpdatedEvent::class => [
            HandleServiceRequestCategoryUpdatedEvent::class
        ],
        ServiceRequestMessageCreatedEvent::class => [
            HandleServiceRequestMessageCreatedEvent::class
        ],
        ServiceRequestOfficeDetailCreatedEvent::class => [
            HandleServiceRequestOfficeDetailCreatedEvent::class
        ],
        ServiceRequestOfficeDetailUpdatedEvent::class => [
            HandleServiceRequestOfficeDetailUpdatedEvent::class
        ],
        StaffCreatedEvent::class => [
            HandleStaffCreatedEvent::class
        ],
        StaffUpdatedEvent::class => [
            HandleStaffUpdatedEvent::class
        ],

        TowerCreatedEvent::class => [
            HandleTowerCreatedEvent::class
        ],
        TowerUpdatedEvent::class => [
            HandleTowerUpdatedEvent::class
        ],

        UnitCreatedEvent::class => [
            HandleUnitCreatedEvent::class
        ],
        UnitUpdatedEvent::class => [
            HandleUnitUpdatedEvent::class
        ],

        UserCreatedEvent::class => [
            HandleUserCreatedEvent::class
        ],
        UserUpdatedEvent::class => [
            HandleUserUpdatedEvent::class
        ],
        UserLoggedInEvent::class => [
            HandleUserLoggedInEvent::class
        ],

        UserNotificationSettingCreatedEvent::class => [
            UserNotificationSettingCreatedEvent::class
        ],
        UserNotificationSettingUpdatedEvent::class => [
            UserNotificationSettingUpdatedEvent::class
        ],
        UserNotificationTypeCreatedEvent::class => [
            HandleUserNotificationTypeCreatedEvent::class
        ],
        UserNotificationTypeUpdatedEvent::class => [
            HandleUserNotificationTypeUpdatedEvent::class
        ],
        UserNotificationCreatedEvent::class => [
            HandleUserNotificationCreatedEvent::class
        ],
        UserNotificationUpdatedEvent::class => [
            HandleUserNotificationUpdatedEvent::class
        ],
        UserProfileCreatedEvent::class => [
            HandleUserProfileCreatedEvent::class
        ],
        UserProfileUpdatedEvent::class => [
            HandleUserProfileUpdatedEvent::class
        ],
        UserProfileChildCreatedEvent::class => [
            HandleUserProfileChildCreatedEvent::class
        ],
        UserProfileChildUpdatedEvent::class => [
            HandleUserProfileChildUpdatedEvent::class
        ],
        UserProfileLinkCreatedEvent::class => [
            HandleUserProfileLinkCreatedEvent::class
        ],
        UserProfileLinkUpdatedEvent::class => [
            HandleUserProfileLinkUpdatedEvent::class
        ],
        UserProfilePostCreatedEvent::class => [
            HandleUserProfilePostCreatedEvent::class
        ],
        UserProfilePostUpdatedEvent::class => [
            HandleUserProfilePostUpdatedEvent::class
        ],
        UserPropertyManagerCreatedEvent::class => [
            HandleUserPropertyManagerCreatedEvent::class
        ],
        UserPropertyManagerUpdatedEvent::class => [
            HandleUserPropertyManagerUpdatedEvent::class
        ],
        UserPropertyResidentCreatedEvent::class => [
            HandleUserPropertyResidentCreatedEvent::class
        ],
        UserPropertyResidentUpdatedEvent::class => [
            HandleUserPropertyResidentUpdatedEvent::class
        ],

        UserRoleCreatedEvent::class => [
            HandleUserRoleCreatedEvent::class
        ],
        UserRoleUpdatedEvent::class => [
            HandleUserRoleUpdatedEvent::class
        ],

        VisitorCreatedEvent::class => [
            HandleVisitorCreatedEvent::class
        ],
        VisitorUpdatedEvent::class => [
            HandleVisitorUpdatedEvent::class
        ],
        VisitorArchiveCreatedEvent::class => [
            HandleVisitorArchiveCreatedEvent::class
        ],
        VisitorArchiveUpdatedEvent::class => [
            HandleVisitorArchiveUpdatedEvent::class
        ],
        VisitorTypeCreatedEvent::class => [
            HandleVisitorTypeCreatedEvent::class
        ],
        VisitorTypeUpdatedEvent::class => [
            HandleVisitorTypeUpdatedEvent::class
        ]
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
