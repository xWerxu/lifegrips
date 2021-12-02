<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShipmentRequest extends FormRequest
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
                Rule::unique('shipment')->ignore($this->shipment_id),
                'max:255'
            ],
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
        ];
    }

    public function messages(){
        return [
            '*.required' => 'To pole jest wymagane',
            'name.max' => 'Maksymalna długość to 255',
            'name.unique' => 'Nazwa opcji dostawy musi być unikalna',
            'price.min' => 'Cena nie może być mniejsza od 0',
            'price.regex' => 'Format ceny to xx.xx',
            'price.numeric' => 'Cena musi być liczbą'
        ];
    }
}
