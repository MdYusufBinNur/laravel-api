<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'unitId', 'residentId', 'typeId', 'enteredUserId', 'trackingNumber', 'comments', 'notifiedByEmail', 'notifiedByText', 'notifiedByVoice'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'notifiedByEmail' => 'boolean',
        'notifiedByText' => 'boolean',
        'notifiedByVoice' => 'boolean',
    ];

    /**
     * user and enterprise user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class,'id','unitId');
    }

    /**
     * user and enterprise user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resident()
    {
        return $this->hasOne(Resident::class,'id','residentId');
    }

    /**
     * user and enterprise user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(PackageType::class,'id','typeId');
    }

}
