<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است',
            'name.string' => 'وارد کردن نام به صورت رشته الزامی است',
            'name.max' => 'وارد کردن نام حداکثر 100 کاراکتر الزامی است',

            'email.required' => 'وارد کردن ایمیل الزامی است',
            'email.unique' => 'ایمیل وارد شده تکراری است',

            'password.required' => 'وارد کردن پسوورد الزامی است',

            'roles.required' => 'وارد کردن نقش کاربر الزامی است',
            'roles.array' => 'وارد کردن نقش کاربر به صورت ارایه الزامی است',

        ];
    }

}
