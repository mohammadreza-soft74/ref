<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'tonnage' => $this->tonnage,
            'code' => $this->code,
            'currencyPerKg' => $this->currencyPerKg,
            'day' => $this->day,
            'appleIn' => $this->appleIn,
            'appleOut' => $this->appleOut,
            'tonnageIn' => $this->tonnageIn,
            'tonnageOut' => $this->tonnageOut,
            'greenIn' => $this->greenIn,
            'greenOut' => $this->greenOut,
            'apple2In' => $this->appleTwoIn,
            'apple2Out' => $this->appleTwoOut,
            'redIn' => $this->redIn,
            'redOut' => $this->redOut,

            'totalWageWithTonnage' => $this->tonnageOut *1000 * $this->currencyPerKg,
            'totalWageWithBasket' => $this->appleIn * 10 * $this->currencyPerKg,

            'apple' => $this->apple,

//            'sum' => $this->sum,

            //'customer' => new CustomerResource($this->customer),
            'fruit' => new FruitResource($this->fruit),
            'apples' => new AppleResourceCollection($this->apples),
            'date' => $this->created_at

        ];
    }
}
