<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AppleReportResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $totalAppleIn = $this->sum('appleIn');
        $totalAppleOut = $this->sum('appleOut');

        return [
            'data' => $this->collection,
            'totalAppleIn' => $totalAppleIn,
            'totalAppleOut' => $totalAppleOut,

        ];
    }
}
