<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceContractResource extends JsonResource
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
            'type' => $this->type->name,
            'creditPriceAvg' => round($this->creditPriceAvg()),
            'cashPriceAvg' => round($this->cashPriceAvg()),
            'amount' => $this->amount,
            //'credit' => $this->credit ,
            'services' => new ServiceResourceCollection($this->services),
            'cashTotalOut' => $this->cashTotalOut(),
            'creditTotalOut' => $this->creditTotalOut(),
            'payed' => $this->payed() ,
            'notPayed' => $this->notPayed() ,
            'date' => $this->created_at
        ];
    }
}
