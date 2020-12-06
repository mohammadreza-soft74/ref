<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Service\ServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $contract = ServiceContract::find($request->contractId);

            $service = new Service($request->only(
                'amount',
                'unitPrice',
                'driver',
                'returned',
                'credit'
            ));

            $service->returnedAmountCheck($contract);

            $service->contract()->associate($contract)->save();


            DB::commit();

            if ($service->amountCheckMessage($contract))
                return response('مقدار خروجی از سقف مقدار قراردادی بیشتر است. سرویس ثبت شد', 201);


//            if ($service->amountCheckMessage($contract))
//                return response("جمع مقدار درخواستی و درخواست های قبلی از $contract->amount بیشتر است واز این پس نسیه محاسبه خواهد شد", 201);


            return response("سرویس با شماره پیگیری $service->id ثبت شد", 201);
        }
        catch (\Exception $ex)
        {
            DB::rollBack();
            throw $ex;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
