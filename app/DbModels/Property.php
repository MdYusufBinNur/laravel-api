<?php

namespace App\DbModels;

use App\Services\Point;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyId', 'type', 'title', 'domain', 'subdomain', 'address', 'city',
        'state', 'postCode', 'country', 'language', 'timezone', 'unregisteredResidentNotifications', 'active',
        'latitude', 'longitude', 'point', 'createdByUserId',
    ];

    protected $casts = [
        'active' => 'boolean',
        'unregisteredResidentNotifications' => 'boolean',
    ];

    
    /**
     * Get the towers for the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function towers()
    {
        return $this->hasMany(Tower::class, 'propertyId', 'id');
    }

    /**
     * Get all of the units for the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function units()
    {
        return $this->hasManyThrough(Unit::class, Tower::class, 'propertyId', 'towerId', 'id', 'id');
    }

    /**
     * Get the company of the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the users for the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(UserRole::class, 'propertyId', 'id');
    }

    /**
     * get images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class, 'propertyId', 'id');
    }

    /**
     * get images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function propertyDesignSetting()
    {
        return $this->hasOne(PropertyDesignSetting::class, 'propertyId', 'id');
    }

    /**
     * @param string $value
     * @return Point
     */
    public function getPointAttribute($value)
    {
        // cleanup the database response into a Point
        $response = explode(
            ' ',
            str_replace(
                [
                    "GeomFromText('",
                    "'",
                    'POINT(',
                    ')'
                ],
                '',
                $value
            )
        );
        return new Point($response[0], $response[1]);
    }

    public function newQuery($excludeDeleted = true)
    {
        $raw = ' astext(point) as point ';
        return parent::newQuery($excludeDeleted)->addSelect('*', \DB::raw($raw));
    }
}
