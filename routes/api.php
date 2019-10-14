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
        Route::get('users-list-auto-complete', 'UserController@usersListAutoComplete');
        Route::apiResource('role', 'RoleController');
        Route::apiResource('user-role', 'UserRoleController');
        Route::apiResource('user-profile', 'UserProfileController');
        Route::apiResource('user-profile-child', 'UserProfileChildController');
        Route::apiResource('user-profile-link', 'UserProfileLinkController');
        Route::apiResource('user-profile-post', 'UserProfilePostController');
        Route::apiResource('staff', 'StaffController');
        Route::post('password-reset', 'PasswordResetController@store');
        Route::get('password-reset/{token}', 'PasswordResetController@show');



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
        Route::apiResource('property-general-info', 'PropertyGeneralInfoController');

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
        Route::apiResource('service-request-message', 'ServiceRequestMessageController');


        /**
         * related to visitors features
         */
        Route::apiResource('visitor-type', 'VisitorTypeController');
        Route::apiResource('visitor', 'VisitorController');
        Route::apiResource('visitor-archive', 'VisitorArchiveController');

        /**
         * related to parking features
         */
        Route::apiResource('parking-space', 'ParkingSpaceController');
        Route::apiResource('parking-pass', 'ParkingPassController');
        Route::apiResource('parking-pass-log', 'ParkingPassLogController', ['except' => ['put']]);

        Route::apiResource('manager-invitation','ManagerInvitationController');

        /**
         * related to Settings System Notification
         */
        Route::apiResource('notification-template-type','NotificationTemplateTypeController');
        Route::apiResource('notification-template','NotificationTemplateController');
        Route::apiResource('notification-template-property','NotificationTemplatePropertyController');

        /**
         * related to FDI
         */
        Route::apiResource('fdi','FdiController');
        Route::apiResource('fdi-log','FdiLogController');
        Route::apiResource('fdi-guest-type','FdiGuestTypeController');

        /**
         * related to Lds
         */
        Route::apiResource('lds-slide','LdsSlideController', ['except' => ['index']]);
        Route::apiResource('lds-setting','LdsSettingController', ['except' => ['destroy']]);
        Route::get('lds-slide-property','LdsSlidePropertyController@index');
        Route::apiResource('lds-blacklist-unit','LdsBlacklistUnitController', ['except' => ['update']]);
        Route::get('lds-packages','LdsController@packages');
        Route::get('lds-announcements','LdsController@announcements');
        Route::get('lds-events','LdsController@events');

        /**
         * related to Message
         */
        Route::apiResource('message', 'MessageController', ['except' => ['update']]);
        Route::apiResource('message-user', 'MessageUserController', ['except' => ['store', 'destroy']]);
        Route::put('message-user-bulk-update-status', 'MessageUserController@bulkUpdate');
        Route::delete('message-user-bulk-delete', 'MessageUserController@bulkDelete');
        Route::apiResource('message-post', 'MessagePostController');
        Route::apiResource('message-template', 'MessageTemplateController');

        /**
         * related to property link
         */
        Route::apiResource('property-link-category', 'PropertyLinkCategoryController');
        Route::apiResource('property-link', 'PropertyLinkController');

        /**
         * related to user property
         */
        Route::apiResource('user-property-resident', 'UserPropertyResidentController');
        Route::apiResource('user-property-manager', 'UserPropertyManagerController');
    });

    //route without authentication
    Route::get('property/{property}', 'PropertyController@show');
    Route::get('property-by-host', 'PropertyController@propertyByHost');
    Route::get('unit', 'UnitController@index');


    Route::apiResource('attachment', 'AttachmentController', ['except' => ['update']]);
    Route::get('attachment-type', 'AttachmentTypeController@index');

    Route::post('resident-access-request', 'ResidentAccessRequestController@store');
    Route::get('resident-access-request-using-pin', 'ResidentAccessRequestController@getByPin');
    Route::post('resident', 'ResidentController@store');

    Route::post('login', 'Auth\\LoginController@index');
    Route::get('logout', 'Auth\\LoginController@logout');
});
