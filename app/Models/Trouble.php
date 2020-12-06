<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trouble extends Model
{
    protected $fillable = ['name'];


    public function apples()
    {
        return $this->morphedByMany(Apple::class, 'troubleable');
    }
}
