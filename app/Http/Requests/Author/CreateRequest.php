<?php

namespace App\Http\Requests\Author;

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
            'name' => 'required',
            'email' => 'required|email'
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => 'Обязательно заполните',
            "email.required"=> 'Обязательно заполните',
        ];
    }
}
