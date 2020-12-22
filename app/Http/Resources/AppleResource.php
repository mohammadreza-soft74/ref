<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppleResource extends JsonResource
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
            'identity' => $this->identity,
            'green' => $this->green,
            'red' => $this->red,
            'apple2' => $this->apple2,
            'tonnage' => $this->tonnage,
            'description' => $this->description,
            'type' => $this->entry,
            'wage' => ($this->green + $this->red) * 10 * $this->contract->currencyPerKg,
            'troubles' => new TroubleResourceCollection($this->troubles),
            'date' => $this->created_at,


        ];
    }
}
