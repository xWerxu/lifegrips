<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
            'main' => 'required|image|mimes:png,jpg|max:2048|dimensions:min_width=350,min_height=350,max_width=1000,max_height=1000',
            'adds.*' => 'image|mimes:png,jpg|max:2048|dimensions:min_width=350,min_height=350,max_width=1000,max_height=1000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'on_stock' => 'required|numeric|min:0'
        ];
    }

    public function messages(){
        return [
            '*.required' => 'To pole jest wymagane',
            'name.max' => 'Maksymalna długość to 255 znaków',
            'name.unique' => 'Nazwa pierwszego wariantu nie może być taka sama jak nazwa innych wariantów w sklepie',
            '*.image' => 'Plik musi być zdjęciem',
            '*.mimes' => 'Obsługiwane formaty to: jpg i png',
            '*.max' => 'Maksymalny rozmiar pliku to 2048KB',
            '*.dimensions' => 'Obraz musi mieć wymiary min. 350x350px, max. 1000x1000px',
            'price.regex' => 'Format ceny to: xx.xx',
            'on_stock.numeric' => 'Wartość musi być liczbą',
            '*.min' => 'Wartość musi być nieujemna',
        ];
    }
}
