<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'key', 'title'
    ];

    // N.B. setting `id` statically for quicker insert where called
    const MODULE_ANNOUNCEMENTS = ['id' => 1, 'key' => 'ANNOUNCEMENTS'];
    const MODULE_PACKAGES = ['id' => 2, 'key' => 'PACKAGES', 'title' => 'Packages'];
    const MODULE_EVENTS = ['id' => 3, 'key' => 'EVENTS', 'title' => 'Events'];
    const MODULE_LDS = ['id' => 4, 'key' => 'LDS', 'title' => 'Lobby display screen'];
    const MODULE_MARKETPLACE = ['id' => 5, 'key' => 'MARKETPLACE', 'title' => 'Marketplace'];
    const MODULE_MESSAGES = ['id' => 6, 'key' => 'MESSAGES', 'title' => 'Messages'];
    const MODULE_SERVICE_REQUEST = ['id' => 7, 'key' => 'SR', 'title' => 'Service Request'];
    const MODULE_OFFERS = ['id' => 8, 'key' => 'OFFERS', 'title' => 'Exclusive Offers'];
    const MODULE_PAYMENT_CENTER = ['id' => 9, 'key' => 'PAYMENT_CENTER', 'title' => 'Payment Center'];
    const MODULE_RESIDENTS = ['id' => 10, 'key' => 'RESIDENTS', 'title' => 'Residents Information'];
    const MODULE_STAFF = ['id' => 11, 'key' => 'STAFF', 'title' => 'Staff users'];
    const MODULE_FRONT_DESK_INSTRUCTION = ['id' => 12, 'key' => 'FDI', 'title' => 'FRONT Gate Instructions'];
    const MODULE_CONTENT = ['id' => 13, 'key' => 'CONTENT', 'title' => 'Content Approval'];
    const MODULE_ENTRY_LOG = ['id' => 14, 'key' => 'EL', 'title' => 'Entry Log'];
    const MODULE_EMPLOYEE_TIME_CLOCK = ['id' => 15, 'key' => 'ETC', 'title' => 'Employee Time Clock'];
    const MODULE_PROFANITY = ['id' => 16, 'key' => 'PROFANITY', 'title' => 'Filter Content for Profanity'];
    const MODULE_AMENITY_RESERVATION= ['id' => 17, 'key' => 'AR', 'title' => 'Amenity Reservation'];
    const MODULE_KEY_LOG = ['id' => 18, 'key' => 'KL', 'title' => 'Key Log'];
    const MODULE_PARKING_PASS = ['id' => 19, 'key' => 'PP', 'title' => 'Parking Passes'];
    const MODULE_EQUIPMENT = ['id' => 20, 'key' => 'EQUIPMENT', 'title' => 'Equipments'];
    const MODULE_MAINTENANCE = ['id' => 21, 'key' => 'MAINTENANCE', 'title' => 'Maintenance'];
    const MODULE_INCOME_EXPENSE = ['id' => 22, 'key' => 'IE', 'title' => 'Income and Expense'];
    const MODULE_COMMUNITY_ACTIVITY = ['id' => 23, 'key' => 'CA', 'title' => 'Community Activities'];
    const MODULE_INVENTORY_PANEL = ['id' => 24, 'key' => 'IP', 'title' => 'Inventory Panel'];
    const MODULE_MY_NEIGHBORS = ['id' => 25, 'key' => 'MN', 'title' => 'My Neighbours'];
    const MODULE_COMMUNITY_INFO = ['id' => 26, 'key' => 'CI', 'title' => 'Community Info'];
    const MODULE_COMMUNITY_LINKS = ['id' => 27, 'key' => 'CL', 'title' => 'Community Links'];
    const MODULE_REGISTRATION_REQUEST = ['id' => 28, 'key' => 'RR', 'title' => 'Registration Requests'];
    const MODULE_APPLICATION_SETTING = ['id' => 29, 'key' => 'AS', 'title' => 'Application Settings'];
    const MODULE_PROPERTY_COMMITTEE = ['id' => 30, 'key' => 'PC', 'title' => 'Property Committee'];
    const MODULE_SMS = ['id' => 31, 'key' => 'SMS', 'title' => 'Text Message'];

    /**
     * get the module
     *
     * @return HasMany
     */
    public function moduleOptions()
    {
        return $this->HasMany(ModuleOption::class, 'moduleId', 'id');
    }
}
