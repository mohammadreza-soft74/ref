<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Http\Resources\ContractResourceCollection;
use App\Http\Resources\customerResource;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;

class customerContractController extends Controller
{
    public function getCustomerContracts(Contract $contract)
    {

        return new ContractResource($contract);
    }
}
