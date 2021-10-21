<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'anons' => ['required'],
            'text'  => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            "title.required" => 'Обязательно заполните',
            "anons.required"=> 'Обязательно заполните',
            "text.required"=> 'Обязательно заполните',
        ];
    }
}
