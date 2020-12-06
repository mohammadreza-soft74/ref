<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabad extends Model
{
    protected $fillable = [
        'basketcount',
        'obasketcount',
        'driver',
        'returned'
    ];

    protected $appends = ['type'];


    public function contract()
    {
        return $this->belongsTo(BasketContract::class,'basket_contract_id');
    }

    public function getTypeAttribute()
    {
        return $this->returned ? 'برگشتی' : 'خروج';
    }




}
