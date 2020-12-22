<?php

namespace App\Http\Requests\Apple;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $date = verta(Carbon::now()->format('Y-m-d'));
        $date->month(1);
        $date->day(1);
        $from = $date->formatGregorian('Y-m-d');


        $date2 = $date->addDays(365);
        $to = $date2->formatGregorian('Y-m-d');

        return [

            'identity' => Rule::unique('apples', 'identity')->where(function ($query) use($from, $to){
                return $query->whereBetween('created_at', [$from, $to]);
            })
        ];
    }

    public function messages()
    {
        return [
           'identity.unique' => 'شماره قبض وارد شده در سال جاری تکراری می باشد'
        ];
    }
}
