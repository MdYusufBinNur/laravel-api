<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Income extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'categoryId','sourceOfIncome', 'amount', 'notes', 'incomeDate', 'propertyId'
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
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(IncomeCategory::class, 'id', 'categoryId');
    }
}
