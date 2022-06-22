<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEscalaSalarial extends FormRequest
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'nivel' => ['required','numeric'],
                'descripcion' => ['required'],
                'casos' => ['required','numeric'],
                'salario_mensual' => ['required','numeric'],
                'estructura_organizacional_id' => ['required','numeric'],
            ];
        }
        return [
            'nivel' => ['required','numeric'],
            'descripcion' => ['required'],
            'casos' => ['required','numeric'],
            'salario_mensual' => ['required','numeric'],
            'estructura_organizacional_id' => ['required','numeric'],
        ];
    }
}
