<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes, CommonModelFeatures;

    const ATTACHMENT_TYPE_GENERIC = 'generic';
    const ATTACHMENT_TYPE_USER_PROFILE = 'user-profile';
    const ATTACHMENT_TYPE_PROPERTY_LOGO = 'property-logo';
    const ATTACHMENT_TYPE_PROPERTY_GALLERY = 'property-gallery';
    const ATTACHMENT_TYPE_PROPERTY_BANNER = 'property-banner';
    const ATTACHMENT_TYPE_PROPERTY_DESIGN_CUSTOM = 'property-custom';
    const ATTACHMENT_TYPE_PROPERTY_SLIDE = 'property-slide';
    const ATTACHMENT_TYPE_SERVICE_REQUEST = 'service-request';
    const ATTACHMENT_TYPE_POST = 'post';
    const ATTACHMENT_TYPE_FDI = 'fdi';
    const ATTACHMENT_TYPE_EVENT = 'event';
    const ATTACHMENT_TYPE_LDS_SLIDE = 'lds-slide';
    const ATTACHMENT_TYPE_VISITOR = 'visitor';
    const ATTACHMENT_TYPE_MESSAGE = 'message';
    const ATTACHMENT_TYPE_MESSAGE_POST = 'message-post';
    const ATTACHMENT_TYPE_EQUIPMENT = 'equipment';
    const ATTACHMENT_TYPE_TEMP = 'temp';
    const ATTACHMENT_TYPE_FEEDBACK = 'feedback';
    const ATTACHMENT_TYPE_STAFF_TIME_CLOCK_IN = 'staff-time-clock-in';
    const ATTACHMENT_TYPE_STAFF_TIME_CLOCK_OUT = 'staff-time-clock-out';
    const ATTACHMENT_TYPE_RESIDENT_DOCUMENT = 'resident-document';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdBy',
        'type',
        'resourceId',
        'fileName',
        'descriptions',
        'fileType',
        'fileSize',
        'hasAvatarSize',
        'hasThumbnailSize',
        'hasMediumSize',
        'hasLargeSize',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hasAvatarSize' => 'boolean',
        'hasThumbnailSize' => 'boolean',
        'hasMediumSize' => 'boolean',
        'hasLargeSize' => 'boolean',
    ];

    /**
     * Get the user who created the attachment
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }

    /**
     * Get storage directory name by attachment type
     *
     * @param $attachmentType
     * @return string
     */
    public function getDirectoryName($attachmentType)
    {
        $directoryName = 'generic';
        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_GENERIC:
                $directoryName = 'generic';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_LOGO:
                $directoryName = 'property-logos';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_BANNER:
                $directoryName = 'property-banners';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_GALLERY:
                $directoryName = 'property-galleries';
                break;
            case self::ATTACHMENT_TYPE_USER_PROFILE:
                $directoryName = 'user-profile-pics';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_DESIGN_CUSTOM:
                $directoryName = 'property-customs';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_SLIDE:
                $directoryName = 'property-slides';
                break;
            case self::ATTACHMENT_TYPE_SERVICE_REQUEST:
                $directoryName = 'service-requests';
                break;
            case self::ATTACHMENT_TYPE_POST:
                $directoryName = 'posts';
                break;
            case self::ATTACHMENT_TYPE_FDI:
                $directoryName = 'fdi';
                break;
            case self::ATTACHMENT_TYPE_EVENT:
                $directoryName = 'events';
                break;
            case self::ATTACHMENT_TYPE_LDS_SLIDE:
                $directoryName = 'lds-slides';
                break;
            case self::ATTACHMENT_TYPE_VISITOR:
                $directoryName = 'visitor';
                break;
            case self::ATTACHMENT_TYPE_MESSAGE:
                $directoryName = 'messages';
                break;
            case self::ATTACHMENT_TYPE_MESSAGE_POST:
                $directoryName = 'message-posts';
                break;
            case self::ATTACHMENT_TYPE_EQUIPMENT:
                $directoryName = 'equipments';
                break;
            case self::ATTACHMENT_TYPE_TEMP:
                $directoryName = 'temp';
                break;
            case self::ATTACHMENT_TYPE_FEEDBACK:
                $directoryName = 'feedback';
                break;
            case self::ATTACHMENT_TYPE_STAFF_TIME_CLOCK_IN:
                $directoryName = 'staff-time-clock-in';
                break;
            case self::ATTACHMENT_TYPE_STAFF_TIME_CLOCK_OUT:
                $directoryName = 'staff-time-clock-out';
                break;
            case self::ATTACHMENT_TYPE_RESIDENT_DOCUMENT:
                $directoryName = 'resident-documents';
                break;
        }

        return $directoryName;
    }

    /**
     * get access type of the attachment
     *
     * @param string $attachmentType
     * @return string
     */
    public function getAccessTypeByAttachmentType($attachmentType)
    {
        $accessType = 'public';

        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_VISITOR:
                $accessType = 'private';
                break;
            case self::ATTACHMENT_TYPE_MESSAGE:
                $accessType = 'private';
                break;
            case self::ATTACHMENT_TYPE_MESSAGE_POST:
                $accessType = 'private';
                break;
            case self::ATTACHMENT_TYPE_POST:
                $accessType = 'private';
                break;
        }
        return $accessType;
    }

    /**
     * get image width and height by image type title
     *
     * @param $title
     * @return array
     */
    public function getImageSizeByTypeTitle($title)
    {
        $sizes = ['width' => 150, 'height' => 150];
        switch (strtolower($title)) {
            case 'avatar':
                $sizes = ['width' => 40, 'height' => 40];
                break;
            case 'thumbnail':
                $sizes = ['width' => 150, 'height' => 150];
                break;
            case 'medium':
                $sizes = ['width' => 300, 'height' => 300];
                break;
            case 'large':
                $sizes = ['width' => 1024, 'height' => 1024];
                break;

        }

        return $sizes;
    }

    /**
     * get attachment file path by type-title(thumbnail, medium, large etc.)
     *
     * @param string $typeTitle
     * @return string
     */
    public function getAttachmentDirectoryPathByTypeTitle($typeTitle = '')
    {
        switch (strtolower($typeTitle)) {
            case 'avatar':
                $path = $typeTitle . '/' . $this->fileName;
                break;
            case 'thumbnail':
                $path = $typeTitle . '/' . $this->fileName;
                break;
            case 'medium':
                $path = $typeTitle . '/' . $this->fileName;
                break;
            case 'large':
                $path = $typeTitle . '/' . $this->fileName;
                break;
            default:
                $path = $this->fileName;

        }

        $directoryName = $this->getDirectoryName($this->type);

        return $directoryName . '/' . $path;
    }

    /**
     * see if image type is available for that attachment
     *
     * @param string $imageType
     * @return bool|mixed
     */
    public function isImageSizeAvailable($imageType = '')
    {
        switch (strtolower($imageType)) {
            case '': //for normal file url
                return true;
                break;
            case 'avatar':
                return $this->hasAvatarSize;
                break;
            case 'thumbnail':
                return $this->hasThumbnailSize;
                break;
            case 'medium':
                return $this->hasMediumSize;
                break;
            case 'large':
                return $this->hasLargeSize;
                break;
            default:
                return false;

        }
    }

    /**
     * generate file URL by type
     *
     * @param string $imageType
     * @return mixed
     */
    public function getFileUrl($imageType = '')
    {
        $accessType = $this->getAccessTypeByAttachmentType($this->type);

        if ($accessType == 'private') {
            return $this->isImageSizeAvailable($imageType) ? \Storage::temporaryUrl($this->getAttachmentDirectoryPathByTypeTitle($imageType), Carbon::now()->addMinutes(10)) : null;
        } else {
            return $this->isImageSizeAvailable($imageType) ? \Storage::url($this->getAttachmentDirectoryPathByTypeTitle($imageType)) : null;
        }
    }
}
