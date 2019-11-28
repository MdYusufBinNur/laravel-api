<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'propertyId'
    ];
}
