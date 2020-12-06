<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $fillable = ['name'];

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
