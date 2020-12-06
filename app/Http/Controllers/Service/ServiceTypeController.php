<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Type[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function index()
    {

        return Type::all()->map(function ($item, $key){
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

        Type::create($request->only('name'));

        return response('خدمت با موفقیت ثبت شد', 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return $type;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type->update($request->only('name'));
        return response('خدمت با موفقیت به روز شد', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {

        if ($type->delete())
            return response('نوع خدمت با موفقیت حذف شد', 201);
        else
            throw ValidationException::withMessages([
                'delete' => ' حذف نوع خدمت به مشکل خورد . لطفا دوباره امتحان کنید.'
            ]);
    }
}
