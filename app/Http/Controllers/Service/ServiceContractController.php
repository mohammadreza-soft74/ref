<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

use App\Http\Resources\Service\ServiceContractResource;
use App\Http\Resources\Service\ServiceContractResourceCollection;
use App\Models\Customer;
use App\Models\Service\ServiceContract;
use App\Models\Service\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServiceContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ServiceContractResourceCollection(ServiceContract::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        if ($request->has('typeId'))
            $serviceType = Type::findOrFail($request->typeId);
        else
            throw ValidationException::withMessages([
                'typeId'=> 'نوع خدمت نامشخص می باشد'
            ]);

        if ($request->has('customerId'))
            $customer = Customer::findOrFail($request->customerId);
        else
            throw ValidationException::withMessages([
                'typeId'=> 'مشتری مورد نظر پیدا نشد'
            ]);

        $serviceContract = new ServiceContract( $request->only('amount') );

        $serviceContract->customer()->associate($customer);
        $serviceContract->type()->associate($serviceType)->save();

        return response("قرارداد به شماره $serviceContract->id ثبت شد.", 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceContract  $serviceContract
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceContract $serviceContract)
    {
        return new ServiceContractResource($serviceContract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceContract  $serviceContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceContract $serviceContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceContract  $serviceContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceContract $serviceContract)
    {
        if ($serviceContract->delete())
            return response('قرارداد خدمات با موفقیت حذف شد.', 201);
        else
            throw ValidationException::withMessages([
                'delete' => 'حذف قرارداد خدمات به مشکل خورد.لطفا دوباره امتحان کنید.'
            ]);

    }
}
