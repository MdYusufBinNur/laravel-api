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

Route::group(['prefix' => 'api/v1'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::apiResource('user', 'UserController');

        Route::apiResource('role', 'RoleController');

        Route::apiResource('user-role', 'UserRoleController');

        Route::apiResource('company', 'CompanyController');

        Route::apiResource('property', 'PropertyController', ['except' => ['get']]);

        Route::apiResource('resident', 'ResidentController',['except' => ['post']]);

        Route::apiResource('tower', 'TowerController');

        Route::apiResource('unit', 'UnitController');

        Route::apiResource('module', 'ModuleController');

        Route::apiResource('module-option', 'ModuleOptionController');

        Route::apiResource('module-property', 'ModulePropertyController');

        Route::apiResource('module-option-property', 'ModuleOptionPropertyController');

        Route::apiResource('announcement', 'AnnouncementController');

        Route::apiResource('event', 'EventController');

        Route::apiResource('event-signup', 'EventSignupController');

        Route::apiResource('notification-feed', 'NotificationFeedController');

        Route::apiResource('package', 'PackageController');

        Route::apiResource('package-archive', 'PackageArchiveController');

        Route::apiResource('package-type', 'PackageTypeController');

        Route::apiResource('property-design-setting', 'PropertyDesignSettingController');

        Route::apiResource('property-social-media', 'PropertySocialMediaController');

        Route::apiResource('resident-access-request', 'ResidentAccessRequestController', ['except' => ['post','get']]);

        Route::apiResource('resident-archive', 'ResidentArchiveController');

        Route::apiResource('resident-emergency', 'ResidentEmergencyController');

        Route::apiResource('resident-vehicle', 'ResidentVehicleController');

        Route::apiResource('parking-pass', 'ParkingPassController');

        Route::apiResource('post', 'PostController');

        Route::apiResource('post-approval-archive', 'PostApprovalArchiveController');

        Route::apiResource('post-approval-blacklist-unit', 'PostApprovalBlacklistUnitController');

        Route::apiResource('post-comment', 'PostCommentController');

        Route::apiResource('post-event', 'PostEventController');

        Route::apiResource('post-marketplace', 'PostMarketplaceController');

        Route::apiResource('post-poll', 'PostPollController');

        Route::apiResource('post-recommendation-type', 'PostRecommendationTypeController');

        Route::apiResource('post-recommendation', 'PostRecommendationController');

        Route::apiResource('post-wall', 'PostWallController');

        Route::apiResource('property-image', 'PropertyImageController');

        Route::apiResource('service-request-category', 'ServiceRequestCategoryController');

        Route::apiResource('service-request', 'ServiceRequestController');

        Route::apiResource('service-request-log', 'ServiceRequestLogController');

        Route::apiResource('service-request-office-detail', 'ServiceRequestOfficeDetailController');

        Route::apiResource('service-request-status', 'ServiceRequestStatusController');

        Route::apiResource('user-notification-setting', 'UserNotificationSettingController');

        Route::apiResource('user-profile', 'UserProfileController');

        Route::apiResource('user-profile-child', 'UserProfileChildController');

        Route::apiResource('user-profile-link', 'UserProfileLinkController');

        Route::apiResource('user-profile-post', 'UserProfilePostController');

        Route::apiResource('visitor-type', 'VisitorTypeController');

        Route::apiResource('visitor', 'VisitorController');

        Route::apiResource('visitor-archive', 'VisitorArchiveController');

        Route::apiResource('role-category', 'RoleCategoryController');

        Route::apiResource('enterprise-user', 'EnterpriseUserController');

        Route::apiResource('enterprise-user-property', 'EnterpriseUserPropertyController');

        Route::apiResource('staff', 'StaffController');

        Route::get('residents-by-units', 'ResidentByUnitController@index');

        Route::apiResource('user-notification-type', 'UserNotificationTypeController');


    });

    //route without authentication
    Route::get('property/{property}', 'PropertyController@show');

    Route::apiResource('attachment', 'AttachmentController', ['except' => ['update']]);
    Route::get('attachment-type', 'AttachmentTypeController@index');

    Route::post('resident-access-request', 'ResidentAccessRequestController@store');

    Route::get('resident-access-request', 'ResidentAccessRequestController@show');

    Route::post('resident', 'ResidentController@store');

    Route::post('login', 'Auth\\LoginController@index');
    Route::get('logout', 'Auth\\LoginController@logout');
});
