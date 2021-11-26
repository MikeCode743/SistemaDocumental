<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Historico\MetadataActaRequest;
use App\Models\Historico\Archivo;
use App\Models\Historico\DetalleItem;
use App\Models\Historico\EstadoItem;
use App\Models\Historico\FormatoDocumento;
use App\Models\Historico\Metadata;
use App\Models\Historico\MetadataActa;
use App\Models\Historico\TemporadaGestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetalleItemController extends Controller
{

    protected $directorio = "SD_Historico";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado_item = EstadoItem::all();
        $formato_documento =  FormatoDocumento::all();
        // $codigo_core_unidad =  CoreUnidades::all();
        // $codigo_core_unidad =  ['codigo' => 'RRHH', 'nombre' => 'Recursos Humanos'];
        $idioma = ['Español', 'Ingles', 'Frances', 'Japonés', 'Alemán'];
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
    public function storeAcuerdo(Request $request)
    {
        $metadata_acuerdo = $this->storeMetadataAcuerdo($request);
        $archivos_bd = $this->subirDocumento($request, "Acuerdos");
        foreach ($archivos_bd as  $archivo) {
            DetalleItem::create([
                'id_gd_archivo' => $archivo->id,
                'id_gd_metadata_acuerdo' => $metadata_acuerdo->id,
            ]);
        }
        return "Guardado con exito";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeActa(Request $request)
    {
        $metadata_acta = $this->storeMetadataActa($request);
        $archivos_bd = $this->subirDocumento($request, "Actas");

        foreach ($archivos_bd as  $archivo) {
            DetalleItem::create([
                'id_gd_archivo' => $archivo->id,
                'id_gd_metadata_acta' => $metadata_acta->id,
            ]);
        }

        return "Guardado con exito";
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMetadataActa($data)
    {
        $acta =  new MetadataActa;
        $acta->numero_acta = $data->numero_acta;
        $acta->id_gd_temporada_gestion = $data->periodo_gestion;
        $acta->save();
        return $acta;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMetadataAcuerdo($data)
    {
        $metadata = new Metadata;
        $metadata->id_gd_estado_item = $data->id_gd_estado_item;
        $metadata->id_gd_formato_documento = $data->id_gd_formato_documento;
        $metadata->codigo_core_unidad = $data->codigo_core_unidad;
        $metadata->titulo = $data->titulo;
        $metadata->titulo_alternativo = $data->titulo_alternativo;
        $metadata->resumen = $data->resumen;
        $metadata->autor = $data->autor;
        $metadata->descripcion = $data->descripcion;
        $metadata->fecha_publicacion = $data->fecha_publicacion;
        $metadata->idioma = $data->idioma;
        $metadata->etiquetas = $data->etiquetas;
        $metadata->informacion_adicional = $data->informacion_adicional;
        $metadata->comentarios = $data->comentarios;
        $metadata->anio_gestion = $data->anio_gestion;
        $metadata->numero_acta = $data->numero_acta;
        $metadata->derechos = $data->derechos;
        $metadata->save();
        $metadata->asuntos()->attach($data->asuntos);

        return $metadata;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\DetalleItem  $detalleItem
     * @return \Illuminate\Http\Response
     */
    public function subirDocumento($data, $categoria)
    {
        $directorio = "/SD_Historico/JuntaDirectiva/" . $categoria;
        $archivos = $data->file('archivos');
        $files  = [];
        foreach ($archivos as $archivo) {
            $nombreArchivo = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $archivo->extension();
            $archivoConExtension = $this->obtenerNombre($directorio, $nombreArchivo, $extension);
            $storePath = Storage::disk('public')->putFileAs($directorio, $archivo, $archivoConExtension);
            $files[] = Archivo::create([
                'nombre' => $archivoConExtension,
                'ruta_almacenado' => $storePath,
                'tipo_mime' => $archivo->getMimeType(),
                'num_version' => 1,
                'espacio_disco' => Storage::disk('public')->size($storePath)
            ]);
        }

        return $files;
    }


    function obtenerNombre($ruta, $nombre, $extension)
    {
        $i = 1;
        $nombreConExtension =  $nombre . "." . $extension;
        $nombreTemporal = $nombre;
        while (Storage::disk('public')->exists($ruta . '/' . $nombre . "." . $extension)) {
            $nombre = (string)$nombreTemporal . ' (' . $i . ')';
            $nombreConExtension = $nombre . "." . $extension;
            $i++;
        }
        return $nombreConExtension;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\DetalleItem  $detalleItem
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleItem $detalleItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\DetalleItem  $detalleItem
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleItem $detalleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\DetalleItem  $detalleItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleItem $detalleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\DetalleItem  $detalleItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleItem $detalleItem)
    {
        //
    }
}
