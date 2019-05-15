<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'signin_user_id', 'unit_id', 'visitor_type_id', 'name', 'phone', 'email', 'company', 'photo', 'permanent', 'comments', 'signature', 'status', 'signin_at'
    ];
}
