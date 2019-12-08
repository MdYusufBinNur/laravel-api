<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

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
    const ATTACHMENT_TYPE_MESSAGE_POST = 'message_post';
    const ATTACHMENT_TYPE_EQUIPMENT = 'equipment';

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
        'fileSize'
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
                $directoryName = 'message_posts';
                break;
            case self::ATTACHMENT_TYPE_EQUIPMENT:
                $directoryName = 'equipments';
                break;
        }

        return $directoryName;
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
}
