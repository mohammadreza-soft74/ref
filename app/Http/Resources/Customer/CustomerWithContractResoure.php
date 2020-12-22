<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\BasketContractResourceCollection;
use App\Http\Resources\ContractResourceCollection;
use App\Http\Resources\Service\ServiceContractResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerWithContractResoure extends JsonResource
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
        ];
    }
}
