<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResourceCollection;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return PermissionResourceCollection
     */
    public function index()
    {
        return Permission::where('guard_name', 'api')->get()->map(function ($item, $key) {
            return ['name' => $item->name];
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        Permission::create(
            $request->only('name', 'guard_name')
        );

        return response('permission created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionStoreRequest $request
     * @param Permission $permission
     * @return void
     */
    public function update(PermissionStoreRequest $request, Permission $permission)
    {
        $permission->update(
            $request->only('name', 'guard_name')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response('deleted successfully', 205);
    }
}
