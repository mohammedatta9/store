<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=>'required|max:50',
            'email'=>'required|max:50',
            'phone'=>'required',
            'type_id'=>'required|numeric',
            'message'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('يجب عليك إدخال  الاسم'),
            'email.required' => __('يجب عليك إدخال  البريد الالكتوني'),
            'phone.required' => __('يجب عليك إدخال  رقم الهاتف'),
            'type_id.required' => __('يجب عليك تحديد نوع الخدمة'),
            'type_id.numeric' => __('يجب عليك تحديد نوع الخدمة'),
            'message.required' => __('يجب عليك إدخال  نص الرسالة'),
            'email.max' => __('يجب ان يكون البريد الالكتروني اقل من 50 حرف'),
            'name.max' => __('يجب ان يكون الاسم اقل من 50 حرف'),
        ];
    }
}
