<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SabadResource extends JsonResource
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
            'basketcount' => $this->basketcount,
            'obasketcount' => $this->obasketcount,
            'returned' => $this->type,
            'driver' => $this->driver,
            'date' => $this->created_at
        ];
    }
}
