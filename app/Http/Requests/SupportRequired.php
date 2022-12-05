<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequired extends FormRequest
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
            'customer_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'status'=>'required',
          //  'price'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'customer_id.required' => 'نام مشتری الزامیست',
            'start_date.required' => 'تاریخ شروع الزامیست',
            'end_date.required' => 'تاریخ پایان الزامیست',
            'status.required' => 'وضعیت الزامیست',
         //   'price.required' => 'قیمت لزامیست',
            //'price.numeric' => 'قیمت را صحیح وارد کنید',
        ];
    }
}
