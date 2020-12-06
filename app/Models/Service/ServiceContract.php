<?php

namespace App\Models\Service;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class ServiceContract extends Model
{

    protected $fillable = ['amount'];
    protected $appends = [
        //'credit'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'service_contract_id', 'id');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cashTotalOut()
    {
       return $this->services()->whereCredit(false)->whereReturned(false)->sum('amount') -
        $this->services()->whereCredit(false)->whereReturned(true)->sum('amount');
    }

    public function creditTotalOut()
    {
       return $this->services()->whereCredit(true)->whereReturned(false)->get()->sum('amount') -
        $this->services()->whereCredit(true)->whereReturned(true)->get()->sum('amount');
    }


    public function payed()
    {
        return $this->services()->whereCredit(false)->whereReturned(false)->get()->sum(function ($t){
            return $t->amount * $t->unitPrice;
            }) -
            $this->services()->whereCredit(false)->whereReturned(true)->get()->sum(function ($t){
                return $t->amount * $t->unitPrice;
            });
    }


    public function notPayed()
    {
        return $this->services()->whereCredit(true)->whereReturned(false)->get()->sum(function ($t){
            return $t->amount * $t->unitPrice;
            }) -
            $this->services()->whereCredit(true)->whereReturned(true)->get()->sum(function ($t){
                return $t->amount * $t->unitPrice;
            });
    }


    public function creditPriceAvg()
    {
        return $this->services()->whereCredit(true)->whereReturned(false)->avg('unitPrice');

    }


    public function cashPriceAvg()
    {
        return $this->services()->whereCredit(false)->whereReturned(false)->avg('unitPrice') ;
    }


//    public function getCreditAttribute($credit)
//    {
//        return $credit ? 'نسیه' : 'نقد';
//    }
}
