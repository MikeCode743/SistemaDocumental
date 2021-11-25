<?php

namespace App\Http\Requests\Historico;

use Illuminate\Foundation\Http\FormRequest;

class AcuerdoCatalogoRequest extends FormRequest
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
            //'name' => 'required|string|max:255',
            'nombre' => 'string|max:50',
            'descripcion' => 'string|max:250'
        ];
    }


    public function messages()
    {
        return [
            // 'usuario.required' => 'Este campo es requerido.'
            'nombre.string' => 'Este campo debe contener letras',
            'nombre.max' => 'Este campo no debe sobrepasar los 50 caracteres',
            'descripcion.string' => 'Este campo debe contener letras',
            'descripcion.max' => 'Este campo no debe sobrepasar los 50 caracteres'

        ];
    }
}
