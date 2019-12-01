<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleSettingProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'module_setting_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'modulePropertyId', 'isActive'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean',
    ];

    /**
     * get the module
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moduleProperty()
    {
        return $this->hasOne(Module::class, 'id', 'modulePropertyId');
    }

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }
}
