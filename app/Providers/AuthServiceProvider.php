<?php

namespace App\Providers;

use App\DbModels\Admin;
use App\DbModels\Announcement;
use App\DbModels\Attachment;
use App\DbModels\Company;
use App\DbModels\EnterpriseUser;
use App\DbModels\EnterpriseUserProperty;
use App\DbModels\Equipment;
use App\DbModels\Event;
use App\DbModels\EventSignup;
use App\DbModels\Fdi;
use App\DbModels\FdiGuestType;
use App\DbModels\FdiLog;
use App\DbModels\InventoryCategory;
use App\DbModels\InventoryItem;
use App\DbModels\InventoryItemLog;
use App\DbModels\LdsBlacklistUnit;
use App\DbModels\LdsSetting;
use App\DbModels\LdsSlide;
use App\DbModels\LdsSlideProperty;
use App\DbModels\Manager;
use App\DbModels\ManagerInvitation;
use App\DbModels\ManagerProperty;
use App\DbModels\Message;
use App\DbModels\MessagePost;
use App\DbModels\MessageTemplate;
use App\DbModels\MessageUser;
use App\DbModels\Module;
use App\DbModels\ModuleOption;
use App\DbModels\ModuleOptionProperty;
use App\DbModels\ModuleProperty;
use App\DbModels\NotificationFeed;
use App\DbModels\NotificationTemplate;
use App\DbModels\NotificationTemplateProperty;
use App\DbModels\NotificationTemplateType;
use App\DbModels\Package;
use App\DbModels\PackageArchive;
use App\DbModels\PackageType;
use App\DbModels\ParkingPass;
use App\DbModels\ParkingPassLog;
use App\DbModels\ParkingSpace;
use App\DbModels\PasswordReset;
use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentMethod;
use App\DbModels\PaymentPaymentMethod;
use App\DbModels\PaymentPublishLog;
use App\DbModels\PaymentRecurring;
use App\DbModels\PaymentType;
use App\DbModels\Post;
use App\DbModels\PostApprovalArchive;
use App\DbModels\PostApprovalBlacklistUnit;
use App\DbModels\PostComment;
use App\DbModels\PostEvent;
use App\DbModels\PostMarketplace;
use App\DbModels\PostPoll;
use App\DbModels\PostRecommendation;
use App\DbModels\PostRecommendationType;
use App\DbModels\PostWall;
use App\DbModels\Property;
use App\DbModels\PropertyDesignSetting;
use App\DbModels\PropertyGeneralInfo;
use App\DbModels\PropertyImage;
use App\DbModels\PropertyLink;
use App\DbModels\PropertyLinkCategory;
use App\DbModels\PropertySocialMedia;
use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use App\DbModels\ResidentArchive;
use App\DbModels\ResidentEmergency;
use App\DbModels\ResidentVehicle;
use App\DbModels\Role;
use App\DbModels\ServiceRequest;
use App\DbModels\ServiceRequestCategory;
use App\DbModels\ServiceRequestLog;
use App\DbModels\ServiceRequestMessage;
use App\DbModels\ServiceRequestOfficeDetail;
use App\DbModels\Tower;
use App\DbModels\Unit;
use App\DbModels\User;
use App\DbModels\UserNotification;
use App\DbModels\UserNotificationSetting;
use App\DbModels\UserNotificationType;
use App\DbModels\UserProfile;
use App\DbModels\UserProfileChild;
use App\DbModels\UserProfileLink;
use App\DbModels\UserProfilePost;
use App\DbModels\UserPropertyManager;
use App\DbModels\UserPropertyResident;
use App\DbModels\UserRole;
use App\DbModels\Visitor;
use App\DbModels\VisitorArchive;
use App\DbModels\VisitorType;
use App\Policies\AdminPolicy;
use App\Policies\AnnouncementPolicy;
use App\Policies\AttachementPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\EnterpriseUserPolicy;
use App\Policies\EnterpriseUserPropertyPolicy;
use App\Policies\EquipmentPolicy;
use App\Policies\EventPolicy;
use App\Policies\EventSignupPolicy;
use App\Policies\FdiGuestTypePolicy;
use App\Policies\FdiLogPolicy;
use App\Policies\FdiPolicy;
use App\Policies\InventoryCategoryPolicy;
use App\Policies\InventoryItemLogPolicy;
use App\Policies\InventoryItemPolicy;
use App\Policies\LdsBlackListUnitPolicy;
use App\Policies\LdsSettingPolicy;
use App\Policies\LdsSlidePolicy;
use App\Policies\LdsSlidePropertyPolicy;
use App\Policies\ManagerInvitationPolicy;
use App\Policies\ManagerPolicy;
use App\Policies\ManagerPropertyPolicy;
use App\Policies\MessagePolicy;
use App\Policies\MessagePostPolicy;
use App\Policies\MessageTemplatePolicy;
use App\Policies\MessageUserPolicy;
use App\Policies\ModuleOptionPolicy;
use App\Policies\ModuleOptionPropertyPolicy;
use App\Policies\ModulePolicy;
use App\Policies\ModulePropertyPolicy;
use App\Policies\NotificationFeedPolicy;
use App\Policies\NotificationTemplatePolicy;
use App\Policies\NotificationTemplatePropertyPolicy;
use App\Policies\NotificationTemplateTypePolicy;
use App\Policies\PackageArchivePolicy;
use App\Policies\PackagePolicy;
use App\Policies\PackageTypePolicy;
use App\Policies\ParkingPassLogPolicy;
use App\Policies\ParkingPassPolicy;
use App\Policies\ParkingSpacePolicy;
use App\Policies\PasswordResetPolicy;
use App\Policies\PaymentItemPolicy;
use App\Policies\PaymentMethodPolicy;
use App\Policies\PaymentPaymentMethodPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PaymentPublishLogPolicy;
use App\Policies\PaymentRecurringPolicy;
use App\Policies\PaymentTypePolicy;
use App\Policies\PostApprovalArchivePolicy;
use App\Policies\PostApprovalBlacklistUnitPolicy;
use App\Policies\PostCommentPolicy;
use App\Policies\PostEventPolicy;
use App\Policies\PostMarketplacePolicy;
use App\Policies\PostPolicy;
use App\Policies\PostPollPolicy;
use App\Policies\PostRecommendationPolicy;
use App\Policies\PostRecommendationTypePolicy;
use App\Policies\PostWallPolicy;
use App\Policies\PropertyDesignSettingPolicy;
use App\Policies\PropertyGeneralInfoPolicy;
use App\Policies\PropertyImagePolicy;
use App\Policies\PropertyLinkCategoryPolicy;
use App\Policies\PropertyLinkPolicy;
use App\Policies\PropertyPolicy;
use App\Policies\PropertySocialMediaPolicy;
use App\Policies\ResidentAccessRequestPolicy;
use App\Policies\ResidentArchivePolicy;
use App\Policies\ResidentEmergencyPolicy;
use App\Policies\ResidentPolicy;
use App\Policies\ResidentVehiclePolicy;
use App\Policies\RolePolicy;
use App\Policies\ServiceRequestCategoryPolicy;
use App\Policies\ServiceRequestLogPolicy;
use App\Policies\ServiceRequestMessagePolicy;
use App\Policies\ServiceRequestOfficeDetailPolicy;
use App\Policies\ServiceRequestPolicy;
use App\Policies\TowerPolicy;
use App\Policies\UnitPolicy;
use App\Policies\UserNotificationPolicy;
use App\Policies\UserNotificationSettingPolicy;
use App\Policies\UserNotificationTypePolicy;
use App\Policies\UserPolicy;
use App\Policies\UserProfileChildPolicy;
use App\Policies\UserProfileLinkPolicy;
use App\Policies\UserProfilePolicy;
use App\Policies\UserProfilePostPolicy;
use App\Policies\UserPropertyManagerPolicy;
use App\Policies\UserPropertyResidentPolicy;
use App\Policies\UserRolePolicy;
use App\Policies\VisitorArchivePolicy;
use App\Policies\VisitorPolicy;
use App\Policies\VisitorTypePolicy;
use App\Services\Helpers\ScopesHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Admin::class => AdminPolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        Attachment::class => AttachementPolicy::class,
        Company::class => CompanyPolicy::class,
        EnterpriseUser::class => EnterpriseUserPolicy::class,
        EnterpriseUserProperty::class => EnterpriseUserPropertyPolicy::class,
        Equipment::class => EquipmentPolicy::class,
        Event::class => EventPolicy::class,
        EventSignup::class => EventSignupPolicy::class,
        FdiGuestType::class => FdiGuestTypePolicy::class,
        FdiLog::class => FdiLogPolicy::class,
        Fdi::class => FdiPolicy::class,
        InventoryCategory::class => InventoryCategoryPolicy::class,
        InventoryItemLog::class => InventoryItemLogPolicy::class,
        InventoryItem::class => InventoryItemPolicy::class,
        LdsSlide::class => LdsSlidePolicy::class,
        LdsSetting::class => LdsSettingPolicy::class,
        LdsSlideProperty::class => LdsSlidePropertyPolicy::class,
        LdsBlacklistUnit::class => LdsBlackListUnitPolicy::class,
        ManagerInvitation::class => ManagerInvitationPolicy::class,
        Manager::class => ManagerPolicy::class,
        ManagerProperty::class => ManagerPropertyPolicy::class,
        Message::class => MessagePolicy::class,
        MessagePost::class => MessagePostPolicy::class,
        MessageTemplate::class => MessageTemplatePolicy::class,
        MessageUser::class => MessageUserPolicy::class,
        Module::class => ModulePolicy::class,
        ModuleOption::class => ModuleOptionPolicy::class,
        ModuleOptionProperty::class => ModuleOptionPropertyPolicy::class,
        ModuleProperty::class => ModulePropertyPolicy::class,
        NotificationFeed::class => NotificationFeedPolicy::class,
        NotificationTemplateType::class => NotificationTemplateTypePolicy::class,
        NotificationTemplate::class => NotificationTemplatePolicy::class,
        NotificationTemplateProperty::class => NotificationTemplatePropertyPolicy::class,
        Package::class => PackagePolicy::class,
        PackageArchive::class => PackageArchivePolicy::class,
        PackageType::class => PackageTypePolicy::class,
        ParkingSpace::class => ParkingSpacePolicy::class,
        ParkingPass::class => ParkingPassPolicy::class,
        ParkingPassLog::class => ParkingPassLogPolicy::class,
        PasswordReset::class => PasswordResetPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
        PaymentType::class => PaymentTypePolicy::class,
        Payment::class => PaymentPolicy::class,
        PaymentItem::class => PaymentItemPolicy::class,
        PaymentRecurring::class => PaymentRecurringPolicy::class,
        PaymentPublishLog::class => PaymentPublishLogPolicy::class,
        PaymentPaymentMethod::class => PaymentPaymentMethodPolicy::class,
        PostApprovalArchive::class => PostApprovalArchivePolicy::class,
        PostApprovalBlacklistUnit::class => PostApprovalBlacklistUnitPolicy::class,
        PostComment::class => PostCommentPolicy::class,
        PostEvent::class => PostEventPolicy::class,
        PostMarketplace::class => PostMarketplacePolicy::class,
        Post::class => PostPolicy::class,
        PostPoll::class => PostPollPolicy::class,
        PostRecommendation::class => PostRecommendationPolicy::class,
        PostRecommendationType::class => PostRecommendationTypePolicy::class,
        PostWall::class => PostWallPolicy::class,
        PropertyDesignSetting::class => PropertyDesignSettingPolicy::class,
        PropertyGeneralInfo::class => PropertyGeneralInfoPolicy::class,
        PropertyImage::class => PropertyImagePolicy::class,
        PropertyLinkCategory::class => PropertyLinkCategoryPolicy::class,
        PropertyLink::class => PropertyLinkPolicy::class,
        Property::class => PropertyPolicy::class,
        PropertySocialMedia::class => PropertySocialMediaPolicy::class,
        ResidentAccessRequest::class => ResidentAccessRequestPolicy::class,
        ResidentArchive::class => ResidentArchivePolicy::class,
        ResidentEmergency::class => ResidentEmergencyPolicy::class,
        Resident::class => ResidentPolicy::class,
        ResidentVehicle::class => ResidentVehiclePolicy::class,
        Role::class => RolePolicy::class,
        ServiceRequestCategory::class => ServiceRequestCategoryPolicy::class,
        ServiceRequestLog::class => ServiceRequestLogPolicy::class,
        ServiceRequestMessage::class => ServiceRequestMessagePolicy::class,
        ServiceRequestOfficeDetail::class => ServiceRequestOfficeDetailPolicy::class,
        ServiceRequest::class => ServiceRequestPolicy::class,
        Tower::class => TowerPolicy::class,
        Unit::class => UnitPolicy::class,
        UserNotification::class => UserNotificationPolicy::class,
        UserNotificationSetting::class => UserNotificationSettingPolicy::class,
        UserNotificationType::class => UserNotificationTypePolicy::class,
        User::class => UserPolicy::class,
        UserProfileChild::class => UserProfileChildPolicy::class,
        UserProfileLink::class => UserProfileLinkPolicy::class,
        UserProfile::class => UserProfilePolicy::class,
        UserProfilePost::class => UserProfilePostPolicy::class,
        UserPropertyManager::class => UserPropertyManagerPolicy::class,
        UserPropertyResident::class => UserPropertyResidentPolicy::class,
        UserRole::class => UserRolePolicy::class,
        VisitorArchive::class => VisitorArchivePolicy::class,
        Visitor::class => VisitorPolicy::class,
        VisitorType::class => VisitorTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan(ScopesHelper::allScopes());

        Passport::routes(null, ['prefix' => 'api/v1/oauth']);
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(15));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
