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

    public function buscar(Request $request)
    {
        $data = $request->only(['numero_acta', 'temporada_gestion']);

        $query = MetadataActa::query();

        $query->when(true, function ($q) use($data) {
            $q->select(['gd_metadata_acta.id', 'id_gd_temporada_gestion', 'numero_acta', 'anio_inicio', 'anio_finalizacion', 'nombre_rector', 'gd_archivo.id as id_archivo', 'gd_archivo.nombre', 'gd_archivo.ruta_almacenado']);
            $q->join('gd_temporada_gestion', 'gd_metadata_acta.id_gd_temporada_gestion', 'gd_temporada_gestion.id');
            $q->join('gd_detalle_archivo', 'gd_detalle_archivo.id_gd_metadata_acta', 'gd_metadata_acta.id');
            $q->join('gd_archivo', 'gd_detalle_archivo.id_gd_archivo', 'gd_archivo.id');
            return $q;
        });
        $query->when(!empty($data['numero_acta']) , function ($q) use ($data){
            return $q->where("numero_acta", $data['numero_acta']);
        });
        $query->when(!empty($data['titulo_alternativo']), function ($q) use($data) {
            return $q->where("id_gd_temporada_gestion", $data['temporada_gestion']);
        });

        $actas = $query->get();

        return view('modulos.historico.components.listado-items', compact('actas'));
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerActaPorTemporada()
    {
        $resultados = [];

        $temporadas = TemporadaGestion::all();
        
        $actas = MetadataActa::select('gd_metadata_acta.id','gd_metadata_acta.numero_acta', 'gd_metadata_acta.id_gd_temporada_gestion')
        ->join('gd_temporada_gestion','gd_metadata_acta.id_gd_temporada_gestion', 'gd_temporada_gestion.id')
        ->get();

        $i = 0;
        foreach ($temporadas as $t => $temporada) {

            $resultados[$i]['temporada'] = date('Y', strtotime($temporada['anio_inicio'])). '-'. date('Y',strtotime($temporada['anio_finalizacion']));
            $resultados[$i]['isOpen']= false;
            $resultados[$i]['actas']= [];
            $resultados[$i]['actas']= $actas->where('id_gd_temporada_gestion', $temporada['id'])->values();
            $i++;
        }

        return $resultados;
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
