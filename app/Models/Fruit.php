<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $fillable = ['name'];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
