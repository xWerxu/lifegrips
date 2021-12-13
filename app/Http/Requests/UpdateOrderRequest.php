<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'item.*.quantity' => 'required|min:1'
        ];
    }

    public function messages(){
        return [
            '*.required' => 'Ilość zamówionych przedmiotów nie może być mniejsza od 1',
            '*.min' => 'Ilość zamówionych przedmiotów nie może być mniejsza od 1'
        ];
    }
}
