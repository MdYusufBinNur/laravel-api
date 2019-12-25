<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use CommonModelFeatures;

    /**
     * primaryKey
     *
     * @var string
     * @access protected
     */
    protected $primaryKey = 'token';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone', 'token'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    const UPDATED_AT = null;

    /**
     * get the user
     *
     * @return User
     */
    public function getUser()
    {
        return User::where(['email' => $this->email])
            ->orWhere(['phone' => $this->phone])
            ->first();
    }
}
