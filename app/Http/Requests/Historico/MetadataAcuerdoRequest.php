<?php

namespace App\Http\Requests\Historico;

use Illuminate\Foundation\Http\FormRequest;

class MetadataAcuerdoRequest extends FormRequest
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
            'id_gd_estado_item' => 'required',
            'id_gd_formato_documento' => 'required',
            //Multiple
            // 'id_gd_asuntos_catalogo' => 'required',
            'core_unidades' => 'required',

            'titulo' => 'required|string|max:500',
            'titulo_alternativo' => 'required|string',
            'autor' => 'required|string',
            'fecha_publicacion' => 'required',
            'anio_gestion' => 'required',
            'resumen' => 'string',
            'descripcion' => 'string',
            'idioma' => 'string',
            'etiquetas' => 'string',
            'informacion_adicional' => 'string',
            'comentarios' => 'string',
            'derechos' => 'string',
        ];
    }

    public function messages()
    {
        return [
            // 'usuario.required' => 'Este campo es requerido.'
            'titulo.required' => 'Este campo es requerido',
            'titulo.string' => 'Este campo debe contener letras',
            'titulo.max' => 'Este campo no debe exceder de los 500 caracteres',
            'titulo_alternativo.string' => 'Este campo debe contener letras',
            'titulo_alternativo.required' => 'Este campo es requerido',

            'autor.string' => 'Este campo debe contener letras',
            'autor.required' => 'Este campo es requerido',
            'fecha_publicacion.required' => 'Este campo es requerido',
            'anio_gestion.required' => 'Este campo es requerido',

            'id_gd_estado_item.required' => 'Este campo es requerido',
            'id_gd_formato_documento.required' => 'Este campo es requerido',
            'core_unidades.required' => 'Este campo es requerido',


            'resumen.string' => 'Este campo debe contener letras',
            'descripcion.string' => 'Este campo debe contener letras',
            'idioma.string' => 'Este campo debe contener letras',
            'etiquetas.string' => 'Este campo debe contener letras',
            'informacion_adicional.string' => 'Este campo debe contener letras',
            'comentarios.string' => 'Este campo debe contener letras',
            'derechos.string' => 'Este campo debe contener letras',

        ];
    }
}
