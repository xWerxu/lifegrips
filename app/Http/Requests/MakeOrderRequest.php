<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeOrderRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:16',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'postal_code' => 'required|max:16',
            'payment' => 'required|exists:payment,id',
            'shipment' => 'required|exists:shipment,id'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'To pole jest wymagane',
            '*.max' => 'Przekroczono maksymalną długość',
            'email.email' => 'Wpisz poprawny adres email',
            '*.exists' => 'Ale proszę nie oszukiwać'
        ];
    }
}
