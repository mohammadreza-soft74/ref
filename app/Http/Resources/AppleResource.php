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
            'green' => $this->green,
            'red' => $this->red,
            'tonnage' => $this->tonnage,
            'descrition' => $this->description,
            'type' => $this->entry,
            'wage' => ($this->green + $this->red) * 10 * $this->contract->currencyPerKg,
            'troubles' => new TroubleResourceCollection($this->troubles),
            'date' => $this->created_at,


        ];
    }
}
