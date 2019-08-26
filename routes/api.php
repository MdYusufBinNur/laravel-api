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

        /**
         * related to user features
         */
        Route::apiResource('user', 'UserController');
        Route::apiResource('role', 'RoleController');
        Route::apiResource('user-role', 'UserRoleController');
        Route::apiResource('user-profile', 'UserProfileController');
        Route::apiResource('user-profile-child', 'UserProfileChildController');
        Route::apiResource('user-profile-link', 'UserProfileLinkController');
        Route::apiResource('user-profile-post', 'UserProfilePostController');
        Route::apiResource('staff', 'StaffController');


        /**
         * related to company features
         */
        Route::apiResource('company', 'CompanyController');
        Route::apiResource('enterprise-user', 'EnterpriseUserController');
        Route::apiResource('enterprise-user-property', 'EnterpriseUserPropertyController');


        /**
         * related to property features
         */
        Route::apiResource('property', 'PropertyController', ['except' => ['get']]);
        Route::apiResource('property-design-setting', 'PropertyDesignSettingController');
        Route::apiResource('property-social-media', 'PropertySocialMediaController');
        Route::apiResource('property-image', 'PropertyImageController');
        Route::apiResource('tower', 'TowerController');
      
        Route::apiResource('unit', 'UnitController', ['except' => ['get']]);

        Route::apiResource('module', 'ModuleController');
        Route::apiResource('module-option', 'ModuleOptionController');
        Route::apiResource('module-property', 'ModulePropertyController');
        Route::apiResource('module-option-property', 'ModuleOptionPropertyController');


        /**
         * related to event features
         */
        Route::apiResource('event', 'EventController');
        Route::apiResource('event-signup', 'EventSignupController');

        Route::apiResource('announcement', 'AnnouncementController');


        /**
         * related to residents features
         */
        Route::apiResource('resident', 'ResidentController',['except' => ['post']]);
        Route::put('residents-transfer', 'ResidentController@residentTransfer');
        Route::apiResource('resident-access-request', 'ResidentAccessRequestController', ['except' => ['post']]);
        Route::apiResource('resident-archive', 'ResidentArchiveController');
        Route::apiResource('resident-emergency', 'ResidentEmergencyController');
        Route::apiResource('resident-vehicle', 'ResidentVehicleController');
        Route::get('residents-by-units', 'ResidentByUnitController@index');
        Route::get('resident-access-request-management', 'ResidentAccessRequestController@index');


        /**
         * related to notifications features
         */
        Route::apiResource('notification-feed', 'NotificationFeedController');
        Route::apiResource('user-notification-setting', 'UserNotificationSettingController');
        Route::apiResource('user-notification-type', 'UserNotificationTypeController');
        Route::get('user-notification', 'UserNotificationController@index');
        Route::put('user-notification', 'UserNotificationController@update');
        Route::get('user-notification/{id}', 'UserNotificationController@show');


        /**
         * related to package features
         */
        Route::apiResource('package', 'PackageController');
        Route::apiResource('package-archive', 'PackageArchiveController');
        Route::apiResource('package-type', 'PackageTypeController');


        /**
         * related to post features
         */
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


        /**
         * related to service request features
         */
        Route::apiResource('service-request-category', 'ServiceRequestCategoryController');
        Route::apiResource('service-request', 'ServiceRequestController');
        Route::apiResource('service-request-log', 'ServiceRequestLogController');
        Route::apiResource('service-request-office-detail', 'ServiceRequestOfficeDetailController');
        Route::apiResource('service-request-status', 'ServiceRequestStatusController');


        /**
         * related to visitors features
         */
        Route::apiResource('visitor-type', 'VisitorTypeController');
        Route::apiResource('visitor', 'VisitorController');
        Route::apiResource('visitor-archive', 'VisitorArchiveController');

        /**
         * related to parking features
         */
        Route::apiResource('parking-pass', 'ParkingPassController');

    });

    //route without authentication
    Route::get('property/{property}', 'PropertyController@show');
    Route::get('property-by-host', 'PropertyController@propertyByHost');
    Route::get('unit', 'UnitController@index');


    Route::apiResource('attachment', 'AttachmentController', ['except' => ['update']]);
    Route::get('attachment-type', 'AttachmentTypeController@index');

    Route::post('resident-access-request', 'ResidentAccessRequestController@store');
    Route::get('resident-access-request', 'ResidentAccessRequestController@show');
    Route::post('resident', 'ResidentController@store');

    Route::post('login', 'Auth\\LoginController@index');
    Route::get('logout', 'Auth\\LoginController@logout');
});
