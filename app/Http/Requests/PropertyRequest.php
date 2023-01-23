<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'bail|required',
            'description' => 'bail|required',
            'type_id' => 'required',
            'category_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'currency_id' => 'required',
            'user_id' => 'required',
            'image' => 'image',
            'address' => 'required',
            'lat' => 'required',
            'log' => 'required',

        ];
    }
    public function messages()
    {
        // use trans instead on Lang
        return [
            'username.required' => 'هذا الحقل مطلوب',

        ];
    }
}
