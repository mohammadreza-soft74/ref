<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConstractRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\ContractResource;
use App\Http\Resources\ContractResourceCollection;
use App\Http\Resources\customerResource;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ContractResourceCollection(Contract::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConstractRequest $request)
    {
        $fruit = Fruit::find($request->fruitId);

        $customer = Customer::find($request->customerId);

        if (is_null($customer) || is_null($fruit))
            throw ValidationException::withMessages([
               'customer/fruit' => 'ورودی های وارد شده صحیح نمی باشد'
            ]);


       $contract =  Contract::create( $request->only(
           'tonnage',
           'code',
           'day',
           'currencyPerKg',
           'apple'
       ));



       $contract->customer()->associate($customer)->save();
       $contract->fruit()->associate($fruit)->save();

        return response('قرارداد شما با موفقیت ثبت شد', 201);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return new ContractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        if ($contract->delete())
            return response("قرارداد میوه با موفقیت حذف شد.", 201);
        else
            throw ValidationException::withMessages([
                'delete' => "حذف قرارداد به مشکل خورد . لطفا دوباره امتحان کنید"
            ]);
    }
}
