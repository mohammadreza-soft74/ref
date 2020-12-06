<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppleReportResource extends JsonResource
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
            'firstName' => $this->customer->firstName,
            'lastName'=> $this->customer->lastName,
            'tonnage' => $this-> tonnage,
            'code' => $this-> code,
            'day' => $this-> day,
            'currenyPerKg' => $this-> currencyPerKg,
            'appleIn' => $this-> appleIn,
            'appleOut' => $this-> appleOut,
            'date' => $this->created_at

        ];
    }
}
