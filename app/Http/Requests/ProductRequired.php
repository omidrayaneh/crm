<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequired extends FormRequest
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
            'name'=>'required',
            'price'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام محصول الزامیست',
            'price.required' => 'قیمت محصول الزامیست',
            'price.numeric' => 'قیمت محصول را صحیح وارد کنید',
        ];
    }
}
