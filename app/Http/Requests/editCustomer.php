<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editCustomer extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required|numeric',
            'user_name'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام مشتری الزامیست',
            'name.string' => 'نام مشتری الزامیست',
            'email.required' => 'ایمیل الزامیست',
            'email.email' => 'ایمیل را صحیح وارد کنید',
            'address.required' => 'آدرس الزامیست',
            'phone.required' => 'شماره تلفن الزامیست',
            'phone.numeric' => 'شماره تلفن را صحیح وارد کنید',
            'user_name.required' => 'نام مسئول الزامیست',
        ];
    }
}
