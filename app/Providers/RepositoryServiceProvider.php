<?php

namespace App\Providers;

use App\DbModels\Announcement;
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
use App\DbModels\Property;
use App\DbModels\PropertyDesignSetting;
use App\DbModels\PropertySocialMedia;
use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use App\DbModels\ResidentArchive;
use App\DbModels\ResidentEmergency;
use App\DbModels\ResidentVehicle;
use App\DbModels\Role;
use App\DbModels\Tower;
use App\DbModels\Unit;
use App\DbModels\User;
use App\DbModels\UserRole;
use App\Repositories\Contracts\AnnouncementRepository;
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
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\PropertyDesignSettingRepository;
use App\Repositories\Contracts\PropertySocialMediaRepository;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ResidentArchiveRepository;
use App\Repositories\Contracts\ResidentEmergencyRepository;
use App\Repositories\Contracts\ResidentVehicleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Repositories\EloquentAnnouncementRepository;
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
use App\Repositories\EloquentPostRepository;
use App\Repositories\EloquentPropertyDesignSettingRepository;
use App\Repositories\EloquentPropertySocialMediaRepository;
use App\Repositories\EloquentResidentAccessRequestRepository;
use App\Repositories\EloquentResidentArchiveRepository;
use App\Repositories\EloquentResidentEmergencyRepository;
use App\Repositories\EloquentResidentVehicleRepository;
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
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentUserRoleRepository;
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
    }
}
