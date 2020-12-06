<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        return [
            'firstName' => 'required|string|max:20',
            'lastName' => 'required|string|max:20',
            'nationalCode' => 'required|string|min:10|max:10|unique:customers',
            'phone' => 'required|string|min:11|max:11',
            'address' => 'required|string'


        ];
    }

    public function messages()
    {
        return [
            'firsName.required' => 'وارد کردن نام الزامی است',
            'firsName.string' => 'وارد کردن نام به صورت رشته الزامی است',
            'firsName.max' => 'وارد کردن نام حداکثر 20 کاراکتر الزامی است',

            'lastName.required' => 'وارد کردن نام خانوادگی الزامی است',
            'lastName.string' => 'وارد کردن نام خانوادگی به صورت رشته الزامی است',
            'nationalCode.unique' => 'کد ملی وارد شده تکراری است',

            'phone.required' => 'وارد کردن تلفن الزامی است',

            'address.required' => 'وارد کردن ادرس الزامی است',
            'address.string' => 'وارد کردن ادرس به صورت رشته الزامی است',

        ];
    }
}
