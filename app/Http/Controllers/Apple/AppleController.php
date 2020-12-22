<?php

namespace App\Http\Controllers\Apple;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apple\AppleRequest;
use App\Http\Resources\ContractResource;
use App\Models\Apple;
use App\Models\Contract;
use App\Models\Trouble;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppleController extends Controller
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
    public function store(AppleRequest $request)
    {

        $contract = Contract::find($request->contractId);

        $apple =  new Apple($request->only('identity','green', 'red', 'apple2', 'tonnage', 'entry', 'description'));

        if (!$request->entry)
        {
//            if($contract->appleIn - $contract->appleOut < ($request->red + $request->green))
//                throw ValidationException::withMessages(
//                    [
//                        'apple'=> 'مقدار خروجی از کل سیب ها بیشتر است'
//                    ]
//                );

            if (
                $contract->apples()->whereEntry(true)->sum('green') -
                $contract->apples()->whereEntry(false)->sum('green') -
                $request->green < 0
            )
            {
                throw ValidationException::withMessages(
                    [
                        'apple'=> 'سیب سفید خروجی از کل بیشتر است'
                    ]
                );
            }

            if ($contract->apples()->whereEntry(true)->sum('red') -
                $contract->apples()->whereEntry(false)->sum('red') -
                $request->red < 0 )
            {
                throw ValidationException::withMessages(
                    [
                        'apple'=> 'سیب قرمز خروجی از کل بیشتر است'
                    ]
                );
            }

            if ($contract->apples()->whereEntry(true)->sum('apple2') -
                $contract->apples()->whereEntry(false)->sum('apple2') -
                $request->apple2 < 0 )
            {
                throw ValidationException::withMessages(
                    [
                        'apple'=> 'سیب درجه2 خروجی از کل بیشتر است'
                    ]
                );
            }
        }

        $apple->contract()->associate($contract)->save();

        if ($request->checkboxes)
            $apple->troubles()->attach($request->checkboxes);


        return response(" عملیات ورود/خروج موفق. شماره پیگیری($apple->id) ", 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function show(Apple $apple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apple $apple)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apple  $apple
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apple $apple)
    {
        //
    }
}
