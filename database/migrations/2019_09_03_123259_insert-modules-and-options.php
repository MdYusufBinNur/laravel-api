<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertModulesAndOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('modules')->insert([
            ['id' => 1, 'key' => 'ANNOUNCEMENTS', 'title' => 'Announcements'],
            ['id' => 2, 'key' => 'PACKAGES', 'title' => 'Packages'],
            ['id' => 3, 'key' => 'EVENTS', 'title' => 'Events'],
            ['id' => 4, 'key' => 'LDS', 'title' => 'Lobby display screen'],
            ['id' => 5, 'key' => 'MARKETPLACE', 'title' => 'Marketplace'],
            ['id' => 6, 'key' => 'MESSAGES', 'title' => 'Messages'],
            ['id' => 7, 'key' => 'SR', 'title' => 'Service Request'],
            ['id' => 8, 'key' => 'OFFERS', 'title' => 'Exclusive Offers'],
            ['id' => 9, 'key' => 'PAYMENT_CENTER', 'title' => 'Payment Center'],
            ['id' => 10, 'key' => 'RESIDENTS', 'title' => 'Residents Information'],
            ['id' => 11, 'key' => 'STAFF', 'title' => 'Staff users'],
            ['id' => 12, 'key' => 'MGI', 'title' => 'Main Gate Instructions'],
            ['id' => 13, 'key' => 'CONTENT', 'title' => 'Content Approval'],
            ['id' => 14, 'key' => 'EL', 'title' => 'Entry Log'],
            ['id' => 15, 'key' => 'ETC', 'title' => 'Employee Time Clock'],
            ['id' => 16, 'key' => 'PROFANITY', 'title' => 'Filter Content for Profanity'],
            ['id' => 17, 'key' => 'AR', 'title' => 'Amenity Reservation'],
            ['id' => 18, 'key' => 'KL', 'title' => 'Key Log'],

        ]);

        DB::table('module_options')->insert([

            ['moduleId' => 2, 'key' => 'defaultView', 'title' => 'Default View'],
            ['moduleId' => 2, 'key' => 'requireSignature', 'title' => 'Require a signature for releasing a package.'],

            ['moduleId' => 7, 'key' => 'moduleName', 'title' => 'Module name of the SR'],
            ['moduleId' => 7, 'key' => 'residentsLeaveFeedback', 'title' => 'Allow residents to leave feedback on service requests'],
            ['moduleId' => 7, 'key' => 'permissionToEnterOptions', 'title' => 'Allow "permission to enter" options'],
            ['moduleId' => 7, 'key' => 'allowOwnersToSubmitRequests', 'title' => 'Allow only owners to submit service requests'],

            ['moduleId' => 12, 'key' => 'mailHolds', 'title' => 'Enable Mail Holds'],
            ['moduleId' => 12, 'key' => 'generalInstructions', 'title' => 'Enable General Instructions'],
            ['moduleId' => 12, 'key' => 'requireSignatureForAddGuests', 'title' => 'Require a signature from a resident when a guest is added by a staff member on resident\'s behalf'],
            ['moduleId' => 12, 'key' => 'requireApprovalForGuestAdded', 'title' => 'Require management approval when guests are added by residents'],
            ['moduleId' => 12, 'key' => 'allowDeleteAuthorizedGuests', 'title' => 'Allow users to delete authorized guests'],
            ['moduleId' => 12, 'key' => 'allowKeyAccess', 'title' => 'Allow users to give key access permissions'],
            ['moduleId' => 12, 'key' => 'maxGuestsPerUnit', 'title' => 'Max guests per unit'],
            ['moduleId' => 12, 'key' => 'maxStayPerGuest', 'title' => 'Max stay per unit'],
            ['moduleId' => 12, 'key' => 'customDisclaimer', 'title' => 'Add a custom disclaimer for residents at the bottom of the "Add a Guest" form'],

            ['moduleId' => 13, 'key' => 'generalDiscussion', 'title' => 'When a general discussion is posted'],
            ['moduleId' => 13, 'key' => 'marketplaceListing', 'title' => 'When a marketplace listing is posted'],
            ['moduleId' => 13, 'key' => 'neighborRecommendation', 'title' => 'When a neighbor\'s recommendation is posted'],
            ['moduleId' => 13, 'key' => 'pollPosted', 'title' => 'When a poll is posted'],

            ['moduleId' => 14, 'key' => 'autoExpire', 'title' => 'Visitor Expiration'],
            ['moduleId' => 14, 'key' => 'requireVisitorSignature', 'title' => 'Require a signature for logging in visitors'],
            ['moduleId' => 14, 'key' => 'labelPrinter', 'title' => 'Allow printing of visitors tags with a label printer'],

            ['moduleId' => 15, 'key' => 'requireTimeclockPassword', 'title' => 'Require staff user\'s password when clocking in/out'],
            ['moduleId' => 15, 'key' => 'requireTimeclockSignature', 'title' => 'Require a signature when clocking in/out'],
            ['moduleId' => 15, 'key' => 'requireTimeclockPhoto', 'title' => 'Require a webcam photo when clocking in/out'],

            ['moduleId' => 9, 'key' => 'paymentGatewayId', 'title' => 'By which Payment Gateway '],
            ['moduleId' => 9, 'key' => 'managerId', 'title' => 'Manager of the property'],
            ['moduleId' => 9, 'key' => 'propertyId', 'title' => 'For which Property'],
            ['moduleId' => 9, 'key' => 'apiKey', 'title' => 'Api key'],

            ['moduleId' => 17, 'key' => 'approveReservation', 'title' => 'Require Managers to approve reservations made by resident'],

            ['moduleId' => 18, 'key' => 'requireSignature', 'title' => 'Require a signature for releasing a keys'],
            
            ['moduleId' => 9, 'key' => 'propertyId', 'title' => 'For which Property'],
            ['moduleId' => 9, 'key' => 'apiKey', 'title' => 'Api key'],



        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DELETE * FROM modules');
        DB::statement('delele * from modules_options');
    }
}
