<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('payment')->ignore($this->payment_id),
                'max:255'
            ],
            'fee' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
        ];
    }

    public function messages(){
        return [
            '*.required' => 'To pole jest wymagane',
            'name.max' => 'Maksymalna długość to 255',
            'name.unique' => 'Nazwa opcji płatności musi być unikalna',
            'fee.min' => 'Prowizja nie może być mniejsza od 0',
            'fee.regex' => 'Format prowizji to xx.xx',
            'fee.numeric' => 'Prowizja musi być liczbą'
        ];
    }
}
