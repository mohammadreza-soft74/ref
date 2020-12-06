<?php

namespace App\Http\Resources;

use App\Http\Resources\Service\ServiceContractResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[

            'id' => $this->id  ,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'nationalCode' => $this->nationalCode,
            'phone' => $this->phone,
            'address' => $this->address,
            'date' => $this->created_at,
            'contracts' => new ContractResourceCollection($this->contracts),
            'basketContracts' => new BasketContractResourceCollection($this->basketContracts),
            'serviceContracts' => new ServiceContractResourceCollection($this->serviceContracts),
//

        ];
    }
}
