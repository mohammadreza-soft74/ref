<?php

namespace App\Http\Controllers\Sabad;

use App\Http\Controllers\Controller;
use App\Models\BasketContract;
use App\Models\Garardad;
use App\Models\Sabad;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SabadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sabad::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = BasketContract::find($request->contractId);
        //return $contract->basketcount - $contract->baskets()->sum('basketcount') - $request->basketcount ;
        if (!$contract)
            throw ValidationException::withMessages([
                'contract' => 'شماره قرارداد صحیح نمیباشد'
            ]);


        if ($request->returned)
        {
            if ($contract->baskets()->where('returned',false)->sum('basketcount') -
                $contract->baskets()->where('returned',true)->sum('basketcount') -
                $request->basketcount < 0

            )
                throw ValidationException::withMessages([
                    'returendBasket' => 'مقدار برگشتی از مقدار خروجی سبد بیشتر است'
                ]);
        }

        if (!$request->returned)
        {
            if ($contract->baskets()->whereReturned(false)->sum('basketcount') -
                $contract->baskets()->whereReturned(true)->sum('basketcount') +
                $request->basketcount > $contract->basketcount
            )
                throw ValidationException::withMessages([
                    'basket' => 'تعداد سبد خروجی از مقدار مجاز بیشتر است'
                ]);

            if ($contract->baskets()->whereReturned(false)->sum('obasketcount') -
                $contract->baskets()->whereReturned(true)->sum('obasketcount') +
                $request->obasketcount > $contract->obasketcount
            )
                throw ValidationException::withMessages([
                    'basket' => 'تعداد سر سبد خروجی از مقدار مجاز بیشتر است'
                ]);
        }



        $basket = new Sabad($request->only('basketcount', 'obasketcount', 'returned', 'driver'));
        $basket->contract()->associate($contract)->save();

        return response('عملیات خروج/برگشت سبد انجام شد.', 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sabad  $sabad
     * @return \Illuminate\Http\Response
     */
    public function show(Sabad $sabad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sabad  $sabad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sabad $sabad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sabad  $sabad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sabad $sabad)
    {
        //
    }
}
