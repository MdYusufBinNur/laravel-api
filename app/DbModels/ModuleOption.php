<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ModuleOption extends Model
{
    use CommonModelFeatures;

    protected $table = 'module_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'moduleId', 'key', 'title'
    ];

    const PACKAGES_OPTION_DEFAULT_VIEW = ['moduleId' => 2, 'key' => 'defaultView'];
    const PACKAGES_OPTION_REQUIRE_SIGNATURE = ['moduleId' => 2, 'key' => 'requireSignature'];

    const SERVICE_REQUEST_MODULE_NAME = ['moduleId' => 7, 'key' => 'moduleName'];
    const SERVICE_REQUEST_RESIDENT_FEEDBACK_ALLOWED = ['moduleId' => 7, 'key' => 'residentsLeaveFeedback'];
    const SERVICE_REQUEST_PERMISSION_TO_ENTER = ['moduleId' => 7, 'key' => 'permissionToEnterOptions'];
    const SERVICE_REQUEST_ALLOW_OWNERS_TO_SUBMIT_REQUEST = ['moduleId' => 7, 'key' => 'allowOwnersToSubmitRequests'];

    const FRONT_DESK_INSTRUCTION_MAIL_HOLDS = ['moduleId' => 12, 'key' => 'mailHolds'];
    const FRONT_DESK_INSTRUCTION_GENERAL_INSTRUCTION = ['moduleId' => 12, 'key' => 'generalInstructions'];
    const FRONT_DESK_INSTRUCTION_REQUIRE_SIGNATURE_FOR_GUEST_ADDING = ['moduleId' => 12, 'key' => 'requireSignatureForAddGuests'];
    const FRONT_DESK_INSTRUCTION_REQUIRE_APPROVAL_FOR_GUEST_ADDED = ['moduleId' => 12, 'key' => 'requireApprovalForGuestAdded'];
    const FRONT_DESK_INSTRUCTION_ALLOW_DELETE_AUTHORIZE_GUEST = ['moduleId' => 12, 'key' => 'allowDeleteAuthorizedGuests'];
    const FRONT_DESK_INSTRUCTION_ALLOW_KEY_ACCESS = ['moduleId' => 12, 'key' => 'allowKeyAccess'];
    const FRONT_DESK_INSTRUCTION_MAX_GUEST_PER_UNIT = ['moduleId' => 12, 'key' => 'maxGuestsPerUnit'];
    const FRONT_DESK_INSTRUCTION_MAX_STAY_PER_GUEST = ['moduleId' => 12, 'key' => 'maxStayPerGuest'];
    const FRONT_DESK_INSTRUCTION_CUSTOM_DISCLAIMER = ['moduleId' => 12, 'key' => 'customDisclaimer'];

    const CONTENT_GENERAL_DISCUSSION = ['moduleId' => 13, 'key' => 'generalDiscussion'];
    const CONTENT_MARKETPLACE_LISTING = ['moduleId' => 13, 'key' => 'marketplaceListing'];
    const CONTENT_NEIGHBOR_RECOMMENDATION = ['moduleId' => 13, 'key' => 'neighborRecommendation'];
    const CONTENT_POLL_POSTED = ['moduleId' => 13, 'key' => 'pollPosted'];

    const ENTRY_LOG_AUTO_EXPIRE = ['moduleId' => 14, 'key' => 'autoExpire'];
    const ENTRY_LOG_REQUIRE_VISITOR_SIGNATURE = ['moduleId' => 14, 'key' => 'requireVisitorSignature'];
    const ENTRY_LOG_LABEL_PRINTER_ENABLED = ['moduleId' => 14, 'key' => 'labelPrinter'];

    const EMPLOYEE_TIME_CLOCK_REQUIRE_PASSWORD = ['moduleId' => 15, 'key' => 'requireTimeclockPassword'];
    const EMPLOYEE_TIME_CLOCK_REQUIRE_SIGNATURE = ['moduleId' => 15, 'key' => 'requireTimeclockSignature'];
    const EMPLOYEE_TIME_CLOCK_REQUIRE_PHOTO = ['moduleId' => 15, 'key' => 'requireTimeclockPhoto'];
    const EMPLOYEE_TIME_CLOCK_EXTERNAL_DEVICE_SN = ['moduleId' => 15, 'key' => 'externalDeviceSN'];

    const AMENITY_RESERVATION_APPROVAL = ['moduleId' => 17, 'key' => 'approveReservation'];

    const KEY_LOG_REQUIRE_SIGNATURE = ['moduleId' => 18, 'key' => 'requireSignature'];

    const PARKING_PASS_START_TIME = ['moduleId' => 19, 'key' => 'startTime'];
    const PARKING_PASS_END_TIME = ['moduleId' => 19, 'key' => 'endTime'];
    const PARKING_PASS_CUSTOM_MESSAGE = ['moduleId' => 19, 'key' => 'customMessage'];
    const PARKING_PASS_ISSUE_PARKING_PASS = ['moduleId' => 19, 'key' => 'issueParkingPass'];
    const PARKING_PASS_UNIT_LIMIT = ['moduleId' => 19, 'key' => 'unitLimit'];
    const PARKING_PASS_TIME_LIMIT = ['moduleId' => 19, 'key' => 'timeLimit'];
    const PARKING_PASS_MESSAGE = ['moduleId' => 19, 'key' => 'messageInIssueParkingPass'];
    const PARKING_PASS_TEMP_DEFAULT_PARKING_PASS_VALIDATION = ['moduleId' => 19, 'key' => 'tempParkingPassValidationInHour'];

    /**
     * get the module
     *
     * @return HasOne
     */
    public function module()
    {
        return $this->hasOne(Module::class, 'id', 'moduleId');
    }

    /**
     * get the module
     *
     * @return HasMany
     */
    public function moduleOptionsProperty()
    {
        return $this->HasMany(ModuleOptionProperty::class, 'moduleOptionId', 'id');
    }
}
