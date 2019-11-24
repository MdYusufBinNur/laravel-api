<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryId','sourceOfIncome', 'amount', 'notes', 'incomeDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'incomeDate' => 'datetime: Y-m-d',
    ];

    /**
     * get the guest type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(IncomeCategory::class, 'id', 'categoryId');
    }
}
