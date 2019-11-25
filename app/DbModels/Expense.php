<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryId','expenseReason', 'amount', 'notes', 'expenseDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expenseDate' => 'datetime: Y-m-d',
    ];

    /**
     * get the guest type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(ExpenseCategory::class, 'id', 'categoryId');
    }

}