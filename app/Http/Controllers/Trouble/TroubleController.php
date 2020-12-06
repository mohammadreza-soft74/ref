<?php

namespace App\Http\Controllers\Trouble;

use App\Http\Controllers\Controller;
use App\Models\Trouble;
use Illuminate\Http\Request;

class TroubleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Trouble[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response|\Illuminate\Support\Collection
     */
    public function index()
    {
        return Trouble::all()->map(function ($item, $key){
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
        Trouble::create($request->only('name'));

        return response('ایراد با موفقیت ثبت شد', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trouble  $trouble
     * @return \Illuminate\Http\Response
     */
    public function show(Trouble $trouble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trouble  $trouble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trouble $trouble)
    {
        $trouble->update($request->only('name'));
        return response('با موفقیت به روز شد', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trouble  $trouble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trouble $trouble)
    {
        //
    }
}
