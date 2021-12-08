<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'title' => 'required|max:255',
            'image' => 'image|mimes:png,jpg|max:2048|dimensions:min_width=500,min_height=300,max_width=1000,max_height=600',
            'short_description' => 'required|max:512',
            'content' => 'required',
            'background_color' => 'required|max:7',
            'background_products' => 'required|max:7',
            'image_position' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'To pole jest wymagane',
            'title.max' => 'Tytuł może mieć maksymalnie 255 znaków',
            'image.image' => 'Plik musi być obrazem',
            'image.mimes' => 'Obsługiwane formaty to: jpg i png',
            'image.dimensions' => 'Minimalne wymiary zdjęcia to 500x300, a maksymalne 1000x600',
            'short_description.max' => 'Krótki opis może składać się z maksymalnie 512 znaków',
            'background_color.max' => 'Wprowadź poprawny kolor',
            'background_products.max' => 'Wprowadź poprawny kolor',
            'image_position.boolean' => 'Proszę nie oszukiwać ogółem'
        ];
    }
}
