<?php

namespace App\Providers;

use Dotenv\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\Resource_;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Validator::extend('my_custom_validation', function ($attr, $value, $params, \Illuminate\Validation\Validator $validator){

            if ($value){

                if ($value =='mohammadreza'){
                    return  true;
                }
            }
        }, ':attribute نباید برار محمدرضا باشد');


         Response::macro('foo', function ($value){
             return $value;
         });

         
    }
}
