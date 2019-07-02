<?php

namespace App\Providers;

use App\DbModels\Announcement;
use App\DbModels\Attachment;
use App\DbModels\Company;
use App\DbModels\Event;
use App\DbModels\EventSignup;
use App\DbModels\Module;
use App\DbModels\ModuleOption;
use App\DbModels\ModuleProperty;
use App\DbModels\ModuleOptionProperty;
use App\DbModels\NotificationFeed;
use App\DbModels\Package;
use App\DbModels\PackageArchive;
use App\DbModels\PackageType;
use App\DbModels\ParkingPass;
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
use App\DbModels\PropertyImage;
use App\DbModels\PropertySocialMedia;
use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use App\DbModels\ResidentArchive;
use App\DbModels\ResidentEmergency;
use App\DbModels\ResidentVehicle;
use App\DbModels\Role;
use App\DbModels\RoleCategory;
use App\DbModels\ServiceRequest;
use App\DbModels\ServiceRequestCategory;
use App\DbModels\ServiceRequestLog;
use App\DbModels\ServiceRequestOfficeDetail;
use App\DbModels\ServiceRequestStatus;
use App\DbModels\Tower;
use App\DbModels\Unit;
use App\DbModels\User;
use App\DbModels\UserNotificationSetting;
use App\DbModels\UserProfile;
use App\DbModels\UserProfileChild;
use App\DbModels\UserProfileLink;
use App\DbModels\UserProfilePost;
use App\DbModels\UserRole;
use App\DbModels\Visitor;
use App\DbModels\VisitorArchive;
use App\DbModels\VisitorType;
use App\Repositories\Contracts\AnnouncementRepository;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\EventRepository;
use App\Repositories\Contracts\EventSignupRepository;
use App\Repositories\Contracts\ModuleOptionRepository;
use App\Repositories\Contracts\ModuleRepository;
use App\Repositories\Contracts\NotificationFeedRepository;
use App\Repositories\Contracts\PackageArchiveRepository;
use App\Repositories\Contracts\PackageRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\ParkingPassRepository;
use App\Repositories\Contracts\PostApprovalArchiveRepository;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;
use App\Repositories\Contracts\PostCommentRepository;
use App\Repositories\Contracts\PostEventRepository;
use App\Repositories\Contracts\PostMarketplaceRepository;
use App\Repositories\Contracts\PostPollRepository;
use App\Repositories\Contracts\PostRecommendationRepository;
use App\Repositories\Contracts\PostRecommendationTypeRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\PostWallRepository;
use App\Repositories\Contracts\PropertyDesignSettingRepository;
use App\Repositories\Contracts\PropertyImageRepository;
use App\Repositories\Contracts\PropertySocialMediaRepository;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentEmergencyRepository;
use App\Repositories\Contracts\ResidentVehicleRepository;
use App\Repositories\Contracts\RoleCategoryRepository;
use App\Repositories\Contracts\ServiceRequestCategoryRepository;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use App\Repositories\Contracts\ServiceRequestOfficeDetailRepository;
use App\Repositories\Contracts\ServiceRequestRepository;
use App\Repositories\Contracts\ServiceRequestStatusRepository;
use App\Repositories\Contracts\UserNotificationSettingRepository;
use App\Repositories\Contracts\UserProfileChildRepository;
use App\Repositories\Contracts\UserProfileLinkRepository;
use App\Repositories\Contracts\UserProfilePostRepository;
use App\Repositories\Contracts\UserProfileRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Repositories\Contracts\VisitorArchiveRepository;
use App\Repositories\Contracts\VisitorRepository;
use App\Repositories\Contracts\VisitorTypeRepository;
use App\Repositories\EloquentAnnouncementRepository;
use App\Repositories\EloquentAttachmentRepository;
use App\Repositories\EloquentEventRepository;
use App\Repositories\EloquentEventSignupRepository;
use App\Repositories\EloquentModuleOptionRepository;
use App\Repositories\EloquentModuleRepository;
use App\Repositories\Contracts\ModulePropertyRepository;
use App\Repositories\EloquentModulePropertyRepository;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use App\Repositories\EloquentModuleOptionPropertyRepository;
use App\Repositories\EloquentNotificationFeedRepository;
use App\Repositories\EloquentPackageArchiveRepository;
use App\Repositories\EloquentPackageRepository;
use App\Repositories\EloquentPackageTypeRepository;
use App\Repositories\EloquentParkingPassRepository;
use App\Repositories\EloquentPostApprovalArchiveRepository;
use App\Repositories\EloquentPostApprovalBlacklistUnitRepository;
use App\Repositories\EloquentPostCommentRepository;
use App\Repositories\EloquentPostEventRepository;
use App\Repositories\EloquentPostMarketplaceRepository;
use App\Repositories\EloquentPostPollRepository;
use App\Repositories\EloquentPostRecommendationRepository;
use App\Repositories\EloquentPostRecommendationTypeRepository;
use App\Repositories\EloquentPostRepository;
use App\Repositories\EloquentPostWallRepository;
use App\Repositories\EloquentPropertyDesignSettingRepository;
use App\Repositories\EloquentPropertyImageRepository;
use App\Repositories\EloquentPropertySocialMediaRepository;
use App\Repositories\EloquentResidentAccessRequestRepository;
use App\Repositories\EloquentResidentArchiveRepository;
use App\Repositories\EloquentResidentEmergencyRepository;
use App\Repositories\EloquentResidentVehicleRepository;
use App\Repositories\EloquentRoleCategoryRepository;
use App\Repositories\EloquentServiceRequestCategoryRepository;
use App\Repositories\EloquentServiceRequestLogRepository;
use App\Repositories\EloquentServiceRequestOfficeDetailRepository;
use App\Repositories\EloquentServiceRequestRepository;
use App\Repositories\EloquentServiceRequestStatusRepository;
use App\Repositories\EloquentUnitRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TowerRepository;
use App\Repositories\Contracts\UnitRepository;
use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentPropertyRepository;
use App\Repositories\EloquentResidentRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentTowerRepository;
use App\Repositories\EloquentUserNotificationSettingRepository;
use App\Repositories\EloquentUserProfileChildRepository;
use App\Repositories\EloquentUserProfileLinkRepository;
use App\Repositories\EloquentUserProfilePostRepository;
use App\Repositories\EloquentUserProfileRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentUserRoleRepository;
use App\Repositories\EloquentVisitorArchiveRepository;
use App\Repositories\EloquentVisitorRepository;
use App\Repositories\EloquentVisitorTypeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // bind UserRepository
        $this->app->bind(UserRepository::class, function() {
            return new EloquentUserRepository(new User());
        });

        // bind CompanyRepository
        $this->app->bind(CompanyRepository::class, function() {
            return new EloquentCompanyRepository(new Company());
        });

        // bind PropertyRepository
        $this->app->bind(PropertyRepository::class, function() {
            return new EloquentPropertyRepository(new Property());
        });

        // bind TowerRepository
        $this->app->bind(TowerRepository::class, function() {
            return new EloquentTowerRepository(new Tower());
        });

        // bind RoleRepository
        $this->app->bind(RoleRepository::class, function() {
            return new EloquentRoleRepository(new Role());
        });

        // bind ResidentRepository
        $this->app->bind(ResidentRepository::class, function() {
            return new EloquentResidentRepository(new Resident());
        });

        // bind UnitRepository
        $this->app->bind(UnitRepository::class, function() {
            return new EloquentUnitRepository(new Unit());
        });

        // bind ModuleRepository
        $this->app->bind(ModuleRepository::class, function() {
            return new EloquentModuleRepository(new Module());
        });

        // bind ModuleOptionRepository
        $this->app->bind(ModuleOptionRepository::class, function() {
            return new EloquentModuleOptionRepository(new ModuleOption());
        });

        // bind ModulePropertyRepository
        $this->app->bind(ModulePropertyRepository::class, function() {
            return new EloquentModulePropertyRepository(new ModuleProperty());
        });

        // bind ModuleOptionPropertyRepository
        $this->app->bind(ModuleOptionPropertyRepository::class, function() {
            return new EloquentModuleOptionPropertyRepository(new ModuleOptionProperty());
        });

        // bind UserRoleRepository
        $this->app->bind(UserRoleRepository::class, function() {
            return new EloquentUserRoleRepository(new UserRole());
        });

        // bind AnnouncementRepository
        $this->app->bind(AnnouncementRepository::class, function() {
            return new EloquentAnnouncementRepository(new Announcement());
        });

        // bind EventRepository
        $this->app->bind(EventRepository::class, function() {
            return new EloquentEventRepository(new Event());
        });

        // bind EventSignupRepository
        $this->app->bind(EventSignupRepository::class, function() {
            return new EloquentEventSignupRepository(new EventSignup());
        });

        // bind NotificationFeedRepository
        $this->app->bind(NotificationFeedRepository::class, function() {
            return new EloquentNotificationFeedRepository(new NotificationFeed());
        });

        // bind PackageRepository
        $this->app->bind(PackageRepository::class, function() {
            return new EloquentPackageRepository(new Package());
        });

        // bind PackageArchiveRepository
        $this->app->bind(PackageArchiveRepository::class, function() {
            return new EloquentPackageArchiveRepository(new PackageArchive());
        });

        // bind PackageTypeRepository
        $this->app->bind(PackageTypeRepository::class, function() {
            return new EloquentPackageTypeRepository(new PackageType());
        });

        // bind PropertyDesignSettingRepository
        $this->app->bind(PropertyDesignSettingRepository::class, function() {
            return new EloquentPropertyDesignSettingRepository(new PropertyDesignSetting());
        });

        // bind PropertySocialMediaRepository
        $this->app->bind(PropertySocialMediaRepository::class, function() {
            return new EloquentPropertySocialMediaRepository(new PropertySocialMedia());
        });

        // bind ResidentAccessRequestRepository
        $this->app->bind(ResidentAccessRequestRepository::class, function() {
            return new EloquentResidentAccessRequestRepository(new ResidentAccessRequest());
        });

        // bind ResidentArchiveRepository
        $this->app->bind(ResidentArchiveRepository::class, function() {
            return new EloquentResidentArchiveRepository(new ResidentArchive());
        });

        // bind ResidentEmergencyRepository
        $this->app->bind(ResidentEmergencyRepository::class, function() {
            return new EloquentResidentEmergencyRepository(new ResidentEmergency());
        });

        // bind ResidentVehicleRepository
        $this->app->bind(ResidentVehicleRepository::class, function() {
            return new EloquentResidentVehicleRepository(new ResidentVehicle());
        });

        // bind ParkingPassRepository
        $this->app->bind(ParkingPassRepository::class, function() {
            return new EloquentParkingPassRepository(new ParkingPass());
        });

        // bind PostRepository
        $this->app->bind(PostRepository::class, function() {
            return new EloquentPostRepository(new Post());
        });

        // bind PostApprovalArchiveRepository
        $this->app->bind(PostApprovalArchiveRepository::class, function() {
            return new EloquentPostApprovalArchiveRepository(new PostApprovalArchive());
        });

        // bind PostApprovalBlacklistUnitRepository
        $this->app->bind(PostApprovalBlacklistUnitRepository::class, function() {
            return new EloquentPostApprovalBlacklistUnitRepository(new PostApprovalBlacklistUnit());
        });

        // bind PostCommentRepository
        $this->app->bind(PostCommentRepository::class, function() {
            return new EloquentPostCommentRepository(new PostComment());
        });

        // bind PostEventRepository
        $this->app->bind(PostEventRepository::class, function() {
            return new EloquentPostEventRepository(new PostEvent());
        });

        // bind PostMarketplaceRepository
        $this->app->bind(PostMarketplaceRepository::class, function() {
            return new EloquentPostMarketplaceRepository(new PostMarketplace());
        });

        // bind PostPollRepository
        $this->app->bind(PostPollRepository::class, function() {
            return new EloquentPostPollRepository(new PostPoll());
        });

        // bind PostRecommendationTypeRepository
        $this->app->bind(PostRecommendationTypeRepository::class, function() {
            return new EloquentPostRecommendationTypeRepository(new PostRecommendationType());
        });

        // bind PostRecommendationRepository
        $this->app->bind(PostRecommendationRepository::class, function() {
            return new EloquentPostRecommendationRepository(new PostRecommendation());
        });

        // bind PostWallRepository
        $this->app->bind(PostWallRepository::class, function() {
            return new EloquentPostWallRepository(new PostWall());
        });

        // bind PropertyImageRepository
        $this->app->bind(PropertyImageRepository::class, function() {
            return new EloquentPropertyImageRepository(new PropertyImage());
        });

        // bind ServiceRequestCategoryRepository
        $this->app->bind(ServiceRequestCategoryRepository::class, function() {
            return new EloquentServiceRequestCategoryRepository(new ServiceRequestCategory());
        });

        // bind ServiceRequestRepository
        $this->app->bind(ServiceRequestRepository::class, function() {
            return new EloquentServiceRequestRepository(new ServiceRequest());
        });

        // bind ServiceRequestLogRepository
        $this->app->bind(ServiceRequestLogRepository::class, function() {
            return new EloquentServiceRequestLogRepository(new ServiceRequestLog());
        });

        // bind ServiceRequestOfficeDetailRepository
        $this->app->bind(ServiceRequestOfficeDetailRepository::class, function() {
            return new EloquentServiceRequestOfficeDetailRepository(new ServiceRequestOfficeDetail());
        });

        // bind ServiceRequestStatusRepository
        $this->app->bind(ServiceRequestStatusRepository::class, function() {
            return new EloquentServiceRequestStatusRepository(new ServiceRequestStatus());
        });

        // bind UserNotificationSettingRepository
        $this->app->bind(UserNotificationSettingRepository::class, function() {
            return new EloquentUserNotificationSettingRepository(new UserNotificationSetting());
        });

        // bind UserProfileRepository
        $this->app->bind(UserProfileRepository::class, function() {
            return new EloquentUserProfileRepository(new UserProfile());
        });

        // bind UserProfileChildRepository
        $this->app->bind(UserProfileChildRepository::class, function() {
            return new EloquentUserProfileChildRepository(new UserProfileChild());
        });

        // bind UserProfileChildRepository
        $this->app->bind(UserProfileLinkRepository::class, function() {
            return new EloquentUserProfileLinkRepository(new UserProfileLink());
        });

        // bind UserProfileChildRepository
        $this->app->bind(UserProfilePostRepository::class, function() {
            return new EloquentUserProfilePostRepository(new UserProfilePost());
        });

        // bind VisitorTypeRepository
        $this->app->bind(VisitorTypeRepository::class, function() {
            return new EloquentVisitorTypeRepository(new VisitorType());
        });

        // bind VisitorTypeRepository
        $this->app->bind(VisitorRepository::class, function() {
            return new EloquentVisitorRepository(new Visitor());
        });

        // bind VisitorArchiveRepository
        $this->app->bind(VisitorArchiveRepository::class, function() {
            return new EloquentVisitorArchiveRepository(new VisitorArchive());
        });

        // bind AttachmentRepository
        $this->app->bind(AttachmentRepository::class, function() {
            return new EloquentAttachmentRepository(new Attachment());
        });

        // bind RoleCategoryRepository
        $this->app->bind(RoleCategoryRepository::class, function() {
            return new EloquentRoleCategoryRepository(new RoleCategory());
        });
    }
}
