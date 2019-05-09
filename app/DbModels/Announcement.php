<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'title', 'content', 'link', 'linkin_new_windows', 'show_on_website', 'show_on_lds', 'expire_at'
    ];
}
