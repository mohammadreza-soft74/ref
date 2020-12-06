<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['name'];

    public  function basketContracts()
    {
        return $this->hasMany(BasketContract::class);
    }
}
