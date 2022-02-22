<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\Metadata;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetadataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $data = $request->only(['titulo', 'titulo_alternativo', 'resumen', 'autor','etiquetas','unidades']);

        
        $query = Metadata::query();

        $query->when(!empty($data['titulo']) , function ($q) use ($data){
            return $q->where('titulo', 'ilike', '%' . $data['titulo'] . '%');
        });
        $query->when(!empty($data['titulo_alternativo']), function ($q) use($data) {
            return $q->where('titulo_alternativo', 'ilike', '%' . $data['titulo_alternativo'] . '%');
        });
        $query->when(!empty($data['resumen']), function ($q) use($data) {
            return $q->where('resumen', 'ilike', '%' . $data['resumen'] . '%');
        });
        $query->when(!empty($data['autor']), function ($q) use($data) {
            return $q->where('autor', 'ilike', '%' . $data['autor'] . '%');
        });

        if(!empty($data['etiquetas'])){
            foreach ($data['etiquetas'] as $i => $etiqueta) {
                $query->when( true , function ($q) use ($etiqueta) {
                    return $q->orWhere('etiquetas', 'ilike', '%' . $etiqueta . '%');
                }); 
            }
        }
        if (!empty($data['unidades'])) {
            foreach ($data['unidades'] as $i => $unidad) {
                $query->when(true, function ($q) use ($unidad) {
                    return $q->orWhere('codigo_core_unidad',$unidad);
                });
            }
        }


        $acuerdos = $query->get();

        if(count($acuerdos) != 0){
            $lista_acuerdos = $acuerdos;
            foreach ($acuerdos as $i => $acuerdo) {
                $lista_acuerdos[$i]['etiquetas'] =  explode(",", str_replace('"', "", $acuerdo['etiquetas']));
            }
            $acuerdos = $lista_acuerdos;
        }
        

        if (count($acuerdos) == 0) {
            return response()->json([
                'actas' => [],
                'mensaje' => "No se encontraron resultados"
            ]);
        }
        return response()->json([
            'actas' => $acuerdos,
            'mensaje' => count($acuerdos) > 1 ? "Se encontraron " . count($acuerdos) . " resultados." : "Se encontro " . count($acuerdos) . " resultado."

        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerAcuerdo(Request $request)
    {
        try {
            
            $data = $request->only('id');
            $acuerdo = Metadata::findOrFail($data['id']);
            $acuerdo['estado'] = $acuerdo->estado()->get();
            $acuerdo['formato'] = $acuerdo->formato()->get();
            $acuerdo['asuntos'] = $acuerdo->acuerdos($data['id']);
            $acuerdo['personas_asociadas'] = $acuerdo->personasAsociadas()->get();
            
            return response()->json([
                'acuerdo' => $acuerdo,
                'mensaje' => "Resultado Obtenido Con Exito"
            ]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'acuerdo' => [],
                'mensaje' => "No se encontraron resultados"
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function show(Metadata $metadata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function edit(Metadata $metadata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metadata $metadata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metadata $metadata)
    {
        //
    }
}
