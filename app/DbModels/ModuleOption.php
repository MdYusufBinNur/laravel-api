<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function module()
    {
        return $this->hasOne(Module::class, 'id', 'moduleId');
    }
}
