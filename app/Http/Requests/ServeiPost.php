<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServeiPost extends FormRequest
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
            'fecha' => 'required|date|after:now|unique:serveis,fecha',
            'horaIni' => 'required',
            'horaFin' => 'required|after:horaIni',
            'plazas' => 'required',
            'overbooking' => 'required',
            'profesCoc' => 'required',
            'profesSala' => 'required',
            'foto' => [\Illuminate\Validation\Rules\File::image()],
        ];
    }

    public function messages()
    {
        return [
            'fecha.after' => 'La fecha debe ser posterior a la fecha actual.',
            'fecha.required' => 'La fecha es obligatoria',
            'fecha.unique' => 'La fecha ya existe en la base de datos.',
            'horaIni.required' => 'La hora de inicio es obligatoria',
            'horaFin.required' => 'La hora de fin es obligatoria',
            'horaFin.after' => 'La hora de fin no puede ser anterior a la hora de inicio',
            'plazas.required' => 'La plazas son obligatorias',
            'overbooking.required' => 'El overbooking es obligatorio',
            'profesCoc.required' => 'Selecciona al menos 1 profesor de cocina',
            'profesSala.required' => 'Selecciona al menos 1 profesor de sala'
        ];
    }
}
