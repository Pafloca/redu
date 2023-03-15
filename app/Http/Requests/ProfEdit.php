<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfEdit extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:3',
            'tipo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es olbigatorio',
            'nombre.min' => 'El nombre tiene que tener más de 3 caracteres',
            'tipo.required' => 'EL tipo es obligatorio'
        ];
    }
}
