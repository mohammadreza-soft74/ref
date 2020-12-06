<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id' => $this -> id,
            'unitPrice' => $this -> unitPrice,
            'returned' => $this -> load,
            'payment' => $this -> payment,
            'amount' => $this -> amount,
            'credit' => $this -> credit,
            'date' => $this -> created_at,

        ];
    }
}
