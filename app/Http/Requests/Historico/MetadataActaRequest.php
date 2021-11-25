<?php

namespace App\Http\Requests\Historico;

use Illuminate\Foundation\Http\FormRequest;

class MetadataActaRequest extends FormRequest
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
            'numero_acta' => 'max:200|required',
            'periodo_gestion' => 'required'
        ];
    }


    public function messages()
    {
        return [
            // 'usuario.required' => 'Este campo es requerido.'
            'numero_acta.max' => 'Este campo debe contener letras',
            'numero_acta.required' => 'Este campo es requerido',
            'periodo_gestion.required' => 'Este campo es requerido',

        ];
    }
}
