<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketReportResource extends JsonResource
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
            'id'=> $this->id,
            'firstName' => $this->customer->firstName,
            'lastName'=> $this->customer->lastName,
            'basket' => $this->basketcount,
            'obasket' => $this->obasketcount,
            'type' => $this->basket->name,
            'basketOut' => $this->baskets()->whereReturned(false)->sum('basketcount')-
                             $this->baskets()->whereReturned(true)->sum('basketcount'),
            'obasketOut' => $this->baskets()->whereReturned(false)->sum('obasketcount')-
                             $this->baskets()->whereReturned(true)->sum('obasketcount'),
            'date' => $this->created_at,
        ];
    }
}
