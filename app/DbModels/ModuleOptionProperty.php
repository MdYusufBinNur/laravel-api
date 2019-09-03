<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleOptionProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'module_option_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'moduleOptionId', 'value'
    ];

    /**
     * get the module
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moduleOption()
    {
        return $this->hasOne(ModuleOption::class, 'id', 'moduleOptionId');
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
