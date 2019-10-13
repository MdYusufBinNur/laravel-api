<?php

use App\DbModels\User;
use App\DbModels\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DbModels\Company::class, 5)->create();

        factory(App\DbModels\Property::class)->create(['subdomain' => 'test']);
        factory(App\DbModels\Property::class, 20)->create();

        //insert a admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Jobber Ali Admin', 'email' => 'admin@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 1]);

        factory(App\DbModels\Admin::class, 5)->create();

        factory(App\DbModels\User::class, 100)->create()->each(function($u) {

            // to avoid duplicate entries in user_roles table
            repeat:
            try {
                factory(App\DbModels\UserRole::class)->create();
            } catch (\Illuminate\Database\QueryException $e) {
                goto repeat;
            }
        });

        factory(App\DbModels\Admin::class, 5)->create();

        factory(App\DbModels\PropertyDesignSetting::class, 5)->create();
        factory(App\DbModels\PropertyImage::class, 5)->create();

        repeat:
            try {
                factory(App\DbModels\PropertySocialMedia::class, 3)->create();
            } catch (\Illuminate\Database\QueryException $e) {
                goto repeat;
            }

        factory(App\DbModels\Tower::class, 30)->create();

        factory(App\DbModels\Unit::class, 100)->create();

        factory(App\DbModels\Resident::class, 100)->create();
        factory(App\DbModels\ResidentEmergency::class, 10)->create();
        factory(App\DbModels\ResidentVehicle::class, 20)->create();
        factory(App\DbModels\ResidentArchive::class, 5)->create();
        factory(App\DbModels\ResidentAccessRequest::class, 5)->create();

        factory(App\DbModels\Announcement::class, 5)->create();

        factory(App\DbModels\UserProfile::class, 20)->create();
        factory(App\DbModels\UserProfileChild::class, 20)->create();
        factory(App\DbModels\UserProfileLink::class, 20)->create();
        factory(App\DbModels\UserProfilePost::class, 20)->create();

        factory(App\DbModels\VisitorType::class, 5)->create();
        factory(App\DbModels\Visitor::class, 20)->create();
        factory(App\DbModels\VisitorArchive::class, 5)->create();

        factory(App\DbModels\ServiceRequestCategory::class, 2)->create();
        factory(App\DbModels\ServiceRequest::class, 3)->create();
        factory(App\DbModels\ServiceRequestOfficeDetail::class, 5)->create();
        factory(App\DbModels\ServiceRequestLog::class, 5)->create();

        factory(App\DbModels\EnterpriseUser::class, 5)->create();
        //factory(App\DbModels\EnterpriseUserProperty::class, 5)->create();

        factory(App\DbModels\Event::class, 5)->create();
        factory(App\DbModels\EventSignup::class, 5)->create();

        factory(App\DbModels\FdiGuestType::class, 5)->create();
        factory(App\DbModels\Fdi::class, 5)->create();
        factory(App\DbModels\FdiLog::class, 5)->create();

        factory(App\DbModels\LdsBlacklistUnit::class, 5)->create();
        factory(App\DbModels\LdsSlide::class, 5)->create();
        factory(App\DbModels\LdsSlideProperty::class, 5)->create();
        factory(App\DbModels\LdsSetting::class, 5)->create();

        factory(App\DbModels\Message::class, 10)->create();
        factory(App\DbModels\MessagePost::class, 10)->create();
        factory(App\DbModels\MessageTemplate::class, 10)->create();
        factory(App\DbModels\MessageUser::class, 10)->create();


        //factory(App\DbModels\Module::class, 10)->create();
        //factory(App\DbModels\ModuleOption::class, 10)->create();
        //factory(App\DbModels\ModuleOptionProperty::class, 10)->create();
        //factory(App\DbModels\ModuleProperty::class, 10)->create();


        factory(App\DbModels\Manager::class, 3)->create();
        factory(App\DbModels\ManagerInvitation::class, 5)->create();
        factory(App\DbModels\ManagerProperty::class, 5)->create();

        factory(App\DbModels\NotificationFeed::class, 10)->create();
        factory(App\DbModels\NotificationTemplateType::class, 2)->create();
        factory(App\DbModels\NotificationTemplate::class, 5)->create();
        factory(App\DbModels\NotificationTemplateProperty::class, 5)->create();

        factory(App\DbModels\PackageType::class, 5)->create();
        factory(App\DbModels\Package::class, 5)->create();
        factory(App\DbModels\PackageArchive::class, 5)->create();

        factory(App\DbModels\ParkingPass::class, 5)->create();

        factory(App\DbModels\Post::class, 5)->create();
        factory(App\DbModels\PostEvent::class, 5)->create();
        factory(App\DbModels\PostMarketplace::class, 5)->create();
        factory(App\DbModels\PostWall::class, 5)->create();
        factory(App\DbModels\PostComment::class, 5)->create();
        factory(App\DbModels\PostPoll::class, 5)->create();
        factory(App\DbModels\PostRecommendation::class, 5)->create();
        factory(App\DbModels\PostApprovalArchive::class, 5)->create();
        factory(App\DbModels\PostApprovalBlacklistUnit::class, 5)->create();

        factory(App\DbModels\UserNotification::class, 10)->create();

        factory(App\DbModels\PropertyLink::class, 10)->create();
    }
}
