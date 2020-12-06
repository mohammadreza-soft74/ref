<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apple extends Model
{
    protected $fillable = [
        'green',
        'red',
        'entry',
        'description',
        'tonnage'
    ];


    public function troubles()
    {
        return $this->morphToMany(Trouble::class, 'troubleable');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function getEntryAttribute($entry)
    {
        return $entry ? 'ورود' : 'خروج';
    }
}
