<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppleReportResourceCollection;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppleController extends Controller
{
    public function appleReport(Request $request)
    {
        if ($request->has('dateFrom') && $request->has('dateTo'))
        {
            $from = $request->dateFrom;
            $to = $request->dateTo;
            return new AppleReportResourceCollection(Contract::whereApple(1)->whereBetween('created_at',[$from, $to])->get());
        }

        if ($request->has('lastName'))
        {
            $lastName = $request->lastName;
            return new AppleReportResourceCollection(Contract::whereApple(1)->whereHas('customer',function ($query) use ($lastName){
                $query->where('lastName' ,'LIKE', '%' . $lastName . '%');
            })->get());

        }
        else
        {
            $date = verta(Carbon::now()->format('Y-m-d'));
            $date->month(1);
            $date->day(1);
            $from = $date->formatGregorian('Y-m-d');

            $date2 = $date->addDays(365);
            $to = $date2->formatGregorian('Y-m-d');

            $contract = Contract::whereApple(1)->whereBetween('created_at', [$from, $to])->get();

            return new AppleReportResourceCollection($contract);

        }

    }
}
