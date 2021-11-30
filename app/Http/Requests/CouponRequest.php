<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'coupon' => [
                'required',
                Rule::unique('coupon')->ignore($this->coupon_id),
                'max:255'
            ],
            'promotion' => 'required|numeric|min:0|max:100'
        ];
    }

    public function messages(){
        return [
            '*.required' => 'To pole jest wymagane',
            'coupon.max' => 'Maksymalna długość to 255',
            'coupon.unique' => 'Kod rabatowy musi być unikalny',
            'promotion.min' => 'Zniżka nie może być mniejsza niż 0%',
            'promotion.max' => 'Zniżka nie może być większa niż 100%',
            'promotion.numeric' => 'Zniżka musi być liczbą'
        ];
    }
}
