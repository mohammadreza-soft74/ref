<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\Customer\CustomerWithContractResoure;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\Customer;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request('year')){

            $date = Verta::parse(\request('year'));
            $from = $date->formatGregorian('Y-m-d');//getGregorian($date->year, $date->month, $date->day);


            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');


            return new CustomerResourceCollection(Customer::whereBetween('created_at', [$from, $to])->paginate(\request('size') ? \request('size') : 30));

        }

        if (\request('lastName')){

            $lastName = \request('lastName');

            $date = verta(Carbon::now()->format('Y-m-d'));
            $date->month(1);
            $date->day(1);
            $from = $date->formatGregorian('Y-m-d');

            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');


            return new CustomerResourceCollection(Customer::whereBetween('created_at', [$from, $to])->where('lastName' ,'LIKE', '%' . $lastName . '%')->paginate(\request('size') ? \request('size') : 30));

        }

        else
        {
            $date = verta(Carbon::now()->format('Y-m-d'));
            $date->month(1);
            $date->day(1);
            $from = $date->formatGregorian('Y-m-d');

            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');


            return new CustomerResourceCollection(Customer::whereBetween('created_at', [$from, $to])->paginate(\request('size') ? \request('size'):30));

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        Customer::create(
            $request->only(
                'firstName',
                'lastName',
                'nationalCode',
                'phone',
                'address'
            )
        );

        return response('مشتری با موفقیت در سیستم ثبت شد', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return CustomerResource
     */
    public function show(Customer $customer)
    {
        return new CustomerWithContractResoure($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {

    }
}
