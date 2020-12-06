<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketContract extends Model
{
    protected $table = 'basketcontracts';
    protected $fillable = [
        'basketcount',
        'obasketcount',
        'currencyPerBasket',
        'driver',
        'credit'
    ];

    protected $appends = [
        'basket_out',
        'obasket_out',
    ];


    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function baskets()
    {
        return $this->hasMany(Sabad::class);
    }

    public function getCreditAttribute($credit)
    {
        return $credit == true ? 'نسیه' : 'نقدی';
    }

    public function getBasketOutAttribute()
    {
        return $this->baskets()->whereReturned(false)->sum('basketcount') -
            $this->baskets()->whereReturned(true)->sum('basketcount');
    }

    public function getObasketOutAttribute()
    {
        return $this->baskets()->whereReturned(false)->sum('obasketcount') -
            $this->baskets()->whereReturned(true)->sum('obasketcount');
    }


}
