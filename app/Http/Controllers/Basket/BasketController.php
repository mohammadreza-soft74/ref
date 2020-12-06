<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Basket[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response|\Illuminate\Support\Collection
     */
    public function index()
    {
        return Basket::all()->map(function ($item, $key){
            return['id' => $item->id, 'name' => $item->name];
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Basket::create($request->only('name'));

        return response('سبد با موفقیت ثبت شد', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        $basket->update($request->only('name'));
        return response('سبد با موفقیت به روز شد', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        return $basket->delete();
        return response('سبد با موفقیت حذف شد', 201);
    }
}
