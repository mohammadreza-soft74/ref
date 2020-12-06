<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'green' => 'required_if:red:|numeric',
            'red' => 'required_if:green:|numeric',
            'entry' => 'boolean|required',
            'description' => 'string|max:255'
        ];
    }
}
