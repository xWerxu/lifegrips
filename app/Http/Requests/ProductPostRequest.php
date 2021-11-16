<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPostRequest extends FormRequest
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
            'name' => 'required|max:255|unique:variants',
            'main' => 'required|image|mimes:png,jpg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'adds.*' => 'image|mimes:png,jpg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'description' => 'max:4096',
            'categories' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'on_stock' => 'required|numeric|min:0'
        ];
    }
}
