<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * get the module
     *
     * @return HasOne
     */
    public function module()
    {
        return $this->hasOne(Module::class, 'id', 'moduleId');
    }
}
