<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group([
    'namespace' => 'User',
    'middleware' => ['cors']
], function (){

    Route::apiResource('users','UserController');//->middleware('auth:api');

});

//Route::group([
//    'namespace' => 'Auth',
//    'middleware' => ['adminAuth']
//], function (){
//
//    Route::post('auth/login', 'LoginController@login');
//
//});

Route::group([
    'namespace' => 'Report',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::get('report/baskets', 'BasketController@basketReport');

    Route::get('report/apples', 'AppleController@appleReport');

});


Route::group([
    'namespace' => 'Service',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('services', 'ServiceController');
    Route::apiResource('serviceContracts', 'ServiceContractController');
    Route::apiResource('types', 'ServiceTypeController');


});



Route::group([
    'namespace' => 'Customer',
    'middleware' => ['cors']
], function (){

    Route::apiResource('customers', 'CustomerController');

});


Route::group([
    'namespace' => 'Contract',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('contracts', 'ContractController');

});

Route::group([
    'namespace' => 'Fruit',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('fruits', 'FruitController');

});

Route::group([
    'namespace' => 'Trouble',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('troubles', 'TroubleController');

});

Route::group([
    'namespace' => 'Apple',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('apples', 'AppleController');

});

Route::group([
    'namespace' => 'Basket',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('basket', 'BasketController');
    Route::apiResource('basketContracts', 'BasketContractController');

});

//
//Route::group([
//    'namespace' => 'Basket',
//    'middleware' => 'cors'
//], function (){
//
//
//
//});

Route::group([
    'namespace' => 'Sabad',
    'middleware' => ['cors', 'auth:api']
], function (){

    Route::apiResource('sabads', 'SabadController');

});





Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth',
    'middleware' => ['adminAuth']
], function() {

    Route::post('login','LoginController@login');
//    Route::post('register','LoginController');

});

//Route::get('hh', function (){
//   $user = \App\Models\Customer::find(2);
//    $user->notify(new \App\Notifications\Reminder());
//});

Route::fallback(function (){
   return response('تلاش شما به جایی نمیرسد. متاسفیم', 404);
});

//Route::group([
//
//    'namespace' => 'Users'
//],
//
//    function() {
//
//        Route::apiResource('permission','PermissionController');
//        Route::apiResource('role','RoleController');
////    Route::post('register','LoginController');
//
//    });




