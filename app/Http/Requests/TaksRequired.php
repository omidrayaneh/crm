<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaksRequired extends FormRequest
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

    public function rules()
    {
        return [
            'customer_id'=>'required',
            'end_date'=>'required',
            'status'=>'required',
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_id.required' => 'نام مشتری الزامیست',
            'end_date.required' => 'تاریخ شروع الزامیست',
            'status.required' => 'وضعیت الزامیست',
            'description.required' => 'شرح فعالیت الزامیست',
        ];
    }
}
