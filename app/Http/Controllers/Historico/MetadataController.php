<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\AcuerdoCatalogo;
use App\Models\Historico\AsuntoCatalogo;
use App\Models\Historico\DetalleItem;
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

        $query->when(true, function ($q) use($data) {
            $q->select(['gd_metadata_acuerdo.*', 'gd_archivo.id as id_archivo', 'gd_archivo.nombre', 'gd_archivo.ruta_almacenado']);
            $q->join('gd_detalle_archivo', 'gd_detalle_archivo.id_gd_metadata_acuerdo', 'gd_metadata_acuerdo.id');
            $q->join('gd_archivo', 'gd_detalle_archivo.id_gd_archivo', 'gd_archivo.id');
            return $q;
        });

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
        


        return $acuerdos;

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
    public function obtenerAcuerdoPorAsunto(Request $request)
    {

        $acuerdo_catalogo = AcuerdoCatalogo::all();
        $asunto_catalogo = AsuntoCatalogo::all();

        $resultado = $acuerdo_catalogo;
        $asuntos = $asunto_catalogo;

        $data = DB::table('gd_detalle_asunto')
        ->join('gd_metadata_acuerdo', 'gd_detalle_asunto.id_gd_metadata_acuerdo', 'gd_metadata_acuerdo.id')
        ->join('gd_asunto_catalogo', 'gd_detalle_asunto.id_gd_asunto_catalogo', 'gd_asunto_catalogo.id')
        ->get();


        foreach ($asunto_catalogo as $a => $asunto) {
            $asuntos[$a]['metadata']=[];
            $asuntos[$a]['metadata'] = $data->where('id_gd_asunto_catalogo', $asunto['id'])->values();    
        }
        
        foreach ($acuerdo_catalogo as $c => $acuerdo) {

            $resultado[$c]['asuntos']= $asuntos->where('id_gd_acuerdo_catalogo', $acuerdo['id'])->values();
        }

        return $resultado;
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
