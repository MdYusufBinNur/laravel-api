<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
    return ['message' => 'Hi from PMS API!'];
});

Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);

Route::resource('role', 'RoleController', ['except' => ['create', 'edit']]);

Route::resource('user-role', 'UserRoleController', ['except' => ['create', 'edit']]);

Route::resource('company', 'CompanyController', ['except' => ['create', 'edit']]);

Route::resource('property', 'PropertyController', ['except' => ['create', 'edit']]);

Route::resource('resident', 'ResidentController', ['except' => ['create', 'edit']]);

Route::resource('tower', 'TowerController', ['except' => ['create', 'edit']]);

Route::resource('unit', 'UnitController', ['except' => ['create', 'edit']]);

Route::resource('module', 'ModuleController', ['except' => ['create', 'edit']]);

Route::resource('module-option', 'ModuleOptionController', ['except' => ['create', 'edit']]);

Route::resource('module-property', 'ModulePropertyController', ['except' => ['create', 'edit']]);

Route::resource('module-option-property', 'ModuleOptionPropertyController', ['except' => ['create', 'edit']]);

Route::resource('announcement', 'AnnouncementController', ['except' => ['create', 'edit']]);

Route::resource('event', 'EventController', ['except' => ['create', 'edit']]);

Route::resource('event-signup', 'EventSignupController', ['except' => ['create', 'edit']]);

Route::resource('notification-feed', 'NotificationFeedController', ['except' => ['create', 'edit']]);

Route::resource('package', 'PackageController', ['except' => ['create', 'edit']]);

Route::resource('package-archive', 'PackageArchiveController', ['except' => ['create', 'edit']]);

Route::resource('package-type', 'PackageTypeController', ['except' => ['create', 'edit']]);

Route::resource('property-design-setting', 'PropertyDesignSettingController', ['except' => ['create', 'edit']]);

Route::resource('property-social-media', 'PropertySocialMediaController', ['except' => ['create', 'edit']]);

Route::resource('resident-access-request', 'ResidentAccessRequestController', ['except' => ['create', 'edit']]);

Route::resource('resident-archive', 'ResidentArchiveController', ['except' => ['create', 'edit']]);

Route::resource('resident-emergency', 'ResidentEmergencyController', ['except' => ['create', 'edit']]);

Route::resource('resident-vehicle', 'ResidentVehicleController', ['except' => ['create', 'edit']]);

Route::resource('parking-pass', 'ParkingPassController', ['except' => ['create', 'edit']]);

Route::resource('post', 'PostController', ['except' => ['create', 'edit']]);

Route::resource('post-approval-archive', 'PostApprovalArchiveController', ['except' => ['create', 'edit']]);

Route::resource('post-approval-blacklist-unit', 'PostApprovalBlacklistUnitController', ['except' => ['create', 'edit']]);

Route::resource('post-comment', 'PostCommentController', ['except' => ['create', 'edit']]);

Route::resource('post-event', 'PostEventController', ['except' => ['create', 'edit']]);

Route::resource('post-marketplace', 'PostMarketplaceController', ['except' => ['create', 'edit']]);

Route::resource('post-poll', 'PostPollController', ['except' => ['create', 'edit']]);

Route::resource('post-recommendation-type', 'PostRecommendationTypeController', ['except' => ['create', 'edit']]);

Route::resource('post-recommendation', 'PostRecommendationController', ['except' => ['create', 'edit']]);

Route::resource('post-wall', 'PostWallController', ['except' => ['create', 'edit']]);

Route::resource('property-image', 'PropertyImageController', ['except' => ['create', 'edit']]);

Route::resource('service-request-category', 'ServiceRequestCategoryController', ['except' => ['create', 'edit']]);

Route::resource('service-request', 'ServiceRequestController', ['except' => ['create', 'edit']]);

Route::resource('service-request-log', 'ServiceRequestLogController', ['except' => ['create', 'edit']]);
