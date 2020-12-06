<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'tonnage',
        'code',
        'day',
        'currencyPerKg',
        'apple'

    ];

    protected $appends = [
        'appleIn',
        'appleOut',
        'greenIn',
        'greenOut',
        'redIn',
        'redOut',
        'tonnageIn'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function fruit()
    {
        return $this->belongsTo(Fruit::class);
    }

    public function apples()
    {
        return $this->hasMany(Apple::class);
    }

    //all entry apple getter
    public function getAppleInAttribute()
    {
        return $this->apples ? $this->apples()->where('entry', true)->sum('green')+
            $this->apples()->where('entry', true)->sum('red'):0;
    }


    //all out apple getter
    public function getAppleOutAttribute()
    {
      return  $this->apples ? $this->apples()->where('entry', false)->sum('green')+
            $this->apples()->where('entry', false)->sum('red'): 0;
    }

    //get all in green apple
    public function getGreenInAttribute()
    {
        return $this->apples ? $this->apples()->where('entry', true)->sum('green') : 0;

    }

    //get all out green apple
    public function getGreenOutAttribute()
    {
        return $this->apples ? $this->apples()->where('entry', false)->sum('green') : 0;

    }

    //get all in red apple
    public function getRedInAttribute()
    {
        return $this->apples ? $this->apples()->where('entry', true)->sum('red') : 0;

    }

    //get all out red apple
    public function getRedOutAttribute()
    {
        return $this->apples ? $this->apples()->where('entry', false)->sum('red') : 0;

    }

    //total in tonnage
    public function getTonnageInAttribute()
    {
        return  $this->apples ? $this->apples()->where('entry', true)->sum('tonnage') : 0 ;
    }

    //total out tonnage
    public function getTonnageOutAttribute()
    {
        return  $this->apples ? $this->apples()->where('entry', false)->sum('tonnage') : 0;

    }

}
