<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\BasketContractResource;
use App\Http\Resources\BasketContractResourceCollection;
use App\Http\Resources\BasketReportResourceCollection;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\BasketContract;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BasketController extends Controller
{
    public function basketReport(Request $request)
    {

        if ($request->has('dateFrom') && $request->has('dateTo'))
        {
            $from = $request->dateFrom;
            $to = $request->dateTo;
            return new BasketReportResourceCollection( BasketContract::whereBetween('created_at',[$from, $to])->get());
        }

//        if ($request->date)
//        {
//            $date = $request->date;
//            return new BasketReportResourceCollection( BasketContract::whereDate('created_at', $date)->get());
//
//        }
        if ($request->has('type'))
        {
            $basketTypeId = $request->type;

            $date = verta(Carbon::now()->format('Y-m-d'));
            $date->month(1);
            $date->day(1);
            $from = $date->formatGregorian('Y-m-d');

            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');

            return new BasketReportResourceCollection(BasketContract::where('basket_id', $basketTypeId)->whereBetween('created_at', [$from, $to])->get());
        }

        else
        {
            $date = verta(Carbon::now()->format('Y-m-d'));
            $date->month(1);
            $date->day(1);
            $from = $date->formatGregorian('Y-m-d');

            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');

            return new BasketReportResourceCollection( BasketContract::whereBetween('created_at', [$from, $to])->get());
        }

    }


    public function userbasketReport(Request $request)
    {

    }

}
