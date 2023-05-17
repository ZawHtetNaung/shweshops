<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiplePriceUpdateRequest extends FormRequest
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
            'price' => 'numeric|min:0',
        ];
    }
    public function messages()
    {
        return[
            'price.min' => 'Price သည် 0 ထပ် မငယ်ရ',
            'price.numeric' => 'Price သည် number ဖြစ်ရမည်',   
        ];
    }
}
