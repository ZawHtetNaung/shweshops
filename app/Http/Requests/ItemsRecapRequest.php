<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRecapRequest extends FormRequest
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
            'name' => 'required',
            // 'အထည်မပျက်ပြန်သွင်း' =>'required|numeric|min:0',
            // 'အထည်ပျက်စီးချို့ယွင်း' => 'required|numeric|min:0',
            // 'တန်ဖိုးမြင့်' => 'required|numeric|min:0',
            'အထည်မပျက်ပြန်သွင်း' =>'required',
            'အထည်ပျက်စီးချို့ယွင်း' => 'required',
            'တန်ဖိုးမြင့်' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Template Name ထည့်ပေးရန်',

            'အထည်မပျက်ပြန်သွင်း.required' => 'အထည်မပျက်ပြန်သွင်း ထည့်ပေးရန်',
            'အထည်မပျက်ပြန်သွင်း.min' => 'အထည်မပျက်ပြန်သွင်း 0 ထပ် မငယ်ရ',
            'အထည်မပျက်ပြန်သွင်း.numeric' => 'အထည်မပျက်ပြန်သွင်းသည် number ဖြစ်ရမည်',

            'အထည်ပျက်စီးချို့ယွင်း.required' => 'အထည်ပျက်စီးချို့ယွင်း ထည့်ပေးရန်',
            'အထည်ပျက်စီးချို့ယွင်း.min' => 'အထည်ပျက်စီးချို့ယွင်း 0 ထပ် မငယ်ရ',
            'အထည်ပျက်စီးချို့ယွင်း.numeric' => 'အထည်ပျက်စီးချို့ယွင်းသည် number ဖြစ်ရမည်',


            'တန်ဖိုးမြင့်.required' => 'တန်ဖိုးမြင့် အထည်နှင့်အထည်မပျက်ပြန်လဲ ထည့်ပေးရန်',
            'တန်ဖိုးမြင့်.min' => 'တန်ဖိုးမြင့် အထည်နှင့်အထည်မပျက်ပြန်လဲ 0 ထပ် မငယ်ရ',
            'တန်ဖိုးမြင့်.numeric' => 'တန်ဖိုးမြင့် အထည်နှင့်အထည်မပျက်ပြန်လဲသည် number ဖြစ်ရမည်',


            
        ];
    }
}
