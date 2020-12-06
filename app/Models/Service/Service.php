<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Service extends Model
{
    protected $fillable = [
        'amount',
        'unitPrice',
        'driver',
        'returned',
        'credit'
    ];
    protected $appends = [
        'payment',
        'load'
    ];
    public function contract()
    {
        return $this->belongsTo(ServiceContract::class, 'service_contract_id', 'id');
    }

//    public function getCreditAttribute($credit)
//    {
//        return $credit ? 'نسیه' : 'نقد';
//    }

    public function returnedAmountCheck(ServiceContract $contract)
    {
        //برگشتی باشد
        if ($this -> returned)
            {
                //نسیه باشد
                if ($this -> credit)
                {
                    $creditRemainingAmount = $contract->services()->whereCredit(true)->whereReturned(false)->sum('amount') -
                        $contract->services()->whereCredit(true)->whereReturned(true)->sum('amount');

                    if ($this->amount > $creditRemainingAmount)
                        throw ValidationException::withMessages([
                            'amount' => 'مقدار برگشتی نسیه از مقدار خروجی کل نسیه بیشتر است'
                        ]);
                }

                //نقدی باشد
                else
                {
                    $cashRemainingAmount = $contract->services()->whereCredit(false)->whereReturned(false)->sum('amount') -
                        $contract->services()->whereCredit(false)->whereReturned(true)->sum('amount');

                    if ($this->amount > $cashRemainingAmount)
                        throw ValidationException::withMessages([
                            'amount' => 'مقدار برگشتی نقدی از مقدار خروجی کل نقدی بیشتر است'
                        ]);
                }
            }

    }

    public function amountCheckMessage(ServiceContract $contract)
    {
        //ورودی باشد
        if (! $this -> returned)
            {
                $cashServicesAmount = $contract->services()->whereReturned(false)->sum('amount') -
                                        $contract->services()->whereReturned(true)->sum('amount');

                if ($cashServicesAmount > $contract->amount)
                    return true;
                else
                    return false;


            }

    }


    public function getLoadAttribute($value)
    {
        return $this->returned ? 'برگشتی' : 'خروجی';
    }


    public function getPaymentAttribute($value)
    {
       return  $this->credit ? 'نسیه' : 'نقدی';
    }


}
