<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class EnterpriseUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'company_id', 'contact_email', 'phone', 'title', 'level'
    ];
}
