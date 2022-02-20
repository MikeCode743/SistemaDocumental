<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\AcuerdoCatalogo;
use App\Models\Historico\AsuntoCatalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsuntoCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $asuntos =  AsuntoCatalogo::all();

        $asuntos = DB::table('gd_asunto_catalogo')
            ->select('gd_asunto_catalogo.id','gd_asunto_catalogo.nombre','gd_acuerdo_catalogo.id as id_gd_acuerdo_catalogo', 'gd_acuerdo_catalogo.nombre as nombre_gd_acuerdo_catalogo', 'gd_asunto_catalogo.descripcion' )
            ->join('gd_acuerdo_catalogo','gd_acuerdo_catalogo.id','gd_asunto_catalogo.id_gd_acuerdo_catalogo')->get(); 

        $acuerdos = AcuerdoCatalogo::all('id', 'nombre as text');
        return view('modulos.historico.administrador.asunto-catalogo', ['data' => $asuntos,'acuerdos'=> $acuerdos]);
        // $asunto = AsuntoCatalogo::all();
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
        try {
            //code..

            $estadoItem = AsuntoCatalogo::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'id_gd_acuerdo_catalogo' => $request->id_gd_acuerdo_catalogo,
                ]
            );
            return back()->with("notificacion", [ 'icon' => 'success', 'title' => 'Done...', 'text' => 'Elemento Agregado']);
        } catch (\Exception $e) {
            return back()->with("notificacion", [ 'icon' => 'error', 'title' => 'No se pudo crear el recurso', 'text' => 'Error']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\AsuntoCatalogo  $asuntoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function show(AsuntoCatalogo $asuntoCatalogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\AsuntoCatalogo  $asuntoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function edit(AsuntoCatalogo $asuntoCatalogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\AsuntoCatalogo  $asuntoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsuntoCatalogo $asuntoCatalogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\AsuntoCatalogo  $asuntoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            AsuntoCatalogo::destroy($id);
            return back()->with("notificacion", [ 'icon' => 'success', 'title' => 'Eliminado...', 'text' => 'Elemento elimiando']);
        } catch (\Exception $e) {
            return back()->with("notificacion", [ 'icon' => 'error', 'title' => 'No se pudo eliminar', 'text' => 'Error al eliminar']);
        }
    }
}
