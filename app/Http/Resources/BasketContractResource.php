<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketContractResource extends JsonResource
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
            'basket' => $this->basketcount,
            'obasket' => $this->obasketcount,
            'driver' => $this->driver,
            'credit' => $this->credit,
            'basketout' => $this->basket_out,
            'obasketout' => $this->obasket_out,
            'currencyPerBasket' => $this->currencyPerBasket,
            'date' => $this->created_at,
            'type' => new BasketResource($this->basket),
            'baskets' => new SabadResourceCollection($this->baskets) ,
        ];
    }
}
