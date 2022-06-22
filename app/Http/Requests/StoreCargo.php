<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCargo extends FormRequest
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
                'nombre' => ['required'],
                'estructura_organizacional_id' => ['required','numeric'],
            ];
        }
        return [
            'nombre' => ['required'],
            'estado' => ['required', 'max:50'],
            'estructura_organizacional_id' => ['required','numeric'],
        ];
    }
}
