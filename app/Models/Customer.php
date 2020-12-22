<?php

namespace App\Models;

use App\Models\Service\ServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;
    protected $fillable = [
        'firstName',
        'lastName',
        'nationalCode',
        'phone',
        'address'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function basketContracts()
    {
        return $this->hasMany(BasketContract::class);
    }

    public function serviceContracts()
    {
        return $this->hasMany(ServiceContract::class);
    }


}
