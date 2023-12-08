<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|min:10',
            'body' => 'required|min:10',
            'price' => 'required',
            'categories' => 'required|array|min:1',
            'categories.*' => 'numeric',
            'images.*' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'min' => 'Campo :attribute deve ter :min caractéres!'
        ];
    }
}
