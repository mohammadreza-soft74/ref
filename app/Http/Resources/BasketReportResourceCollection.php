<?php

namespace App\Http\Resources;

use App\Models\BasketContract;
use App\Models\Contract;
use App\Models\Sabad;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class BasketReportResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        $basketOut = $this->sum('basketOut');
        $obasketOut = $this->sum('obasketOut');
        $totalBasketContracts = $this->sum('basketcount');
        $totalObasketContracts = $this->sum('obasketcount');


        return [
            'data' => $this->collection,
            'basketout' => $basketOut,
            'obasketout' => $obasketOut,
            'totalBasketContracts' => $totalBasketContracts,
            'totalObasketContracts' => $totalObasketContracts


        ];
    }
}
