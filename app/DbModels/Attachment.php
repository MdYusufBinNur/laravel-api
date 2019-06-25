<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

    const ATTACHMENT_TYPE_GENERIC = 'generic';
    const ATTACHMENT_TYPE_PROPERTY_LOGO = 'logo';
    const ATTACHMENT_TYPE_USER_PROFILE_PIC = 'user-profile-pic';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
                $directoryName = 'product-images';
                break;
            case self::ATTACHMENT_TYPE_PROPERTY_LOGO:
                $directoryName = 'logos';
                break;
            case self::ATTACHMENT_TYPE_USER_PROFILE_PIC:
                $directoryName = 'user-profile-pics';
                break;
        }

        return $directoryName;
    }
}
