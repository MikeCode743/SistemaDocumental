<?php

namespace App\Http\Controllers\Historico;

// use App\Models\MetadataActa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Historico\MetadataActa;
use App\Models\Historico\TemporadaGestion;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class MetadataActaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo_gestion = TemporadaGestion::all();
        return view('modulos.historico.crear.acta', compact($periodo_gestion));
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
     * @param  \App\Models\MetadataActa  $metadataActa
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $data = $request->only(['numero_acta', 'temporada_gestion']);

        if (!empty($data['numero_acta']) and !empty($data['temporada_gestion'])) {

            $actas = DB::table('gd_metadata_acta')
                ->select(['gd_metadata_acta.id', 'id_gd_temporada_gestion', 'numero_acta','anio_inicio','anio_finalizacion','nombre_rector'])
                ->join('gd_temporada_gestion', 'gd_metadata_acta.id_gd_temporada_gestion','gd_temporada_gestion.id' )
                ->where("numero_acta", $data['numero_acta'])
                ->where("id_gd_temporada_gestion", $data['temporada_gestion'])
                ->get();

                if(empty($actas)){
                     return response()->json([
                         'actas'=> [],
                         'mensaje'=> "No se encontraron resultados"
                     ]);               
                }
            return response()->json([
                'actas'=>$actas,
                'mensaje' => count($actas) > 1 ? "Se encontraron " . count($actas) . " resultados." : "Se encontro " . count($actas) . " resultado."

            ]);
        }elseif(!empty($data['numero_acta']) and empty($data['temporada_gestion'])){
            $actas = DB::table('gd_metadata_acta')
                ->select(['gd_metadata_acta.id', 'id_gd_temporada_gestion', 'numero_acta', 'anio_inicio', 'anio_finalizacion', 'nombre_rector'])
                ->join('gd_temporada_gestion', 'gd_metadata_acta.id_gd_temporada_gestion', 'gd_temporada_gestion.id')
                ->where("numero_acta", $data['numero_acta'])
                ->get();

            if (empty($actas)) {
                return response()->json([
                    'actas' => [],
                    'mensaje' => "No se encontraron resultados"
                ]);
            }
            return response()->json([
                'actas' => $actas,
                'mensaje' => count($actas) > 1 ? "Se encontraron " . count($actas) . " resultados." : "Se encontro " . count($actas) . " resultado."
            ]);
        } elseif (empty($data['numero_acta']) and !empty($data['temporada_gestion'])) {
            $actas = DB::table('gd_metadata_acta')
                ->select(['gd_metadata_acta.id', 'id_gd_temporada_gestion', 'numero_acta', 'anio_inicio', 'anio_finalizacion', 'nombre_rector'])
                ->join('gd_temporada_gestion', 'gd_metadata_acta.id_gd_temporada_gestion', 'gd_temporada_gestion.id')
                ->where("id_gd_temporada_gestion", $data['temporada_gestion'])
                ->get();

            if (empty($actas)) {
                return response()->json([
                    'actas' => [],
                    'mensaje' => "No se encontraron resultados"
                ]);
            }
            return response()->json([
                'actas' => $actas,
                'mensaje' => count($actas) > 1 ? "Se encontraron " . count($actas) . " resultados." : "Se encontro " . count($actas) . " resultado."
            ]);

        } else {

            return response()->json([
                'actas' => [],
                'mensaje' => "Los datos de busqueda estan vacios"
                ]);
                
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetadataActa  $metadataActa
     * @return \Illuminate\Http\Response
     */
    public function obtenerActa(Request $request)
    {   
        $data= $request->only('id');
        try {
            
            $acta = MetadataActa::findOrFail($data['id']);
    
            $acta['temporada_gestion'] = $acta->temporadaGestion()->select(['id','anio_inicio','anio_finalizacion','nombre_rector'])->get();
    
            $acta['archivos']= $acta->obtenerArchivosActas()->get();

            return response()->json([
                'acta' => $acta,
                'mensaje' => "Resultado Obtenido Con Exito"
            ]);

        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'acta' => [],
                'mensaje' => "No se encontraron resultados"
            ]);
        }

        

        return $acta;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetadataActa  $metadataActa
     * @return \Illuminate\Http\Response
     */
    public function edit(MetadataActa $metadataActa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MetadataActa  $metadataActa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetadataActa $metadataActa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetadataActa  $metadataActa
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetadataActa $metadataActa)
    {
        //
    }
}
