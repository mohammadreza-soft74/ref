<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;
use App\Http\Resources\BasketContractResource;
use App\Http\Resources\BasketResource;
use App\Http\Resources\SabadResourceCollection;
use App\Models\Basket;
use App\Models\BasketContract;
use App\Models\Customer;
use Illuminate\Http\Request;

class BasketContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BasketContract::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $basket = Basket::find($request->basketId);
        $customer = Customer::find($request->customerId);

        if ( is_null($basket) || is_null($customer))
            return response('ورودی نوع سبد صحیح نمی باشد', 500);

        $basketContract =  BasketContract::create( $request->only(
            'basketcount',
            'obasketcount',
            'currencyPerBasket',
            'driver',
            'credit'
        ));


        $basketContract->basket()->associate($basket)->save();
        $basketContract->customer()->associate($customer)->save();

        return response('قرارداد سبد با موفقیت ثبت شد', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BasketContract  $basketContract
     * @return \Illuminate\Http\Response
     */
    public function show(BasketContract $basketContract)
    {
        return new BasketContractResource($basketContract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BasketContract  $basketContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BasketContract $basketContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BasketContract  $basketContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasketContract $basketContract)
    {
        $basketContract->delete();
        return response('قرارداد سبد با موفقیت حذف شد', 201);
    }
}
