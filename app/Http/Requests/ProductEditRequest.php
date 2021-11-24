<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'description' => 'max:4096',
            'categories' => 'required',
            'main_variant' => 'required',
            'product_id' => 'required',
        ];
    }

    public function messages(){
        return [
            '*.required' => 'To pole jest wymagane',
            'description.max' => 'Maksymalna długość opisu to 4096'
        ];
    }
}
