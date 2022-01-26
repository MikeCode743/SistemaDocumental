<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\AcuerdoCatalogo;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class AcuerdoCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return AcuerdoCatalogo::all();

        return view('modulos.historico.administrador.acuerdo-catalogo', ['response' => AcuerdoCatalogo::all()]);
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
            $estadoItem = AcuerdoCatalogo::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                ]
            );
            return back()->with("notificacion", [ 'icon' => 'success', 'title' => 'Done...', 'text' => 'Elemento agregado']);
        } catch (\Exception $e) {
            return back()->with("notificacion", [ 'icon' => 'error', 'title' => 'No se pudo crear el recurso', 'text' => 'Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\AcuerdoCatalogo  $acuerdoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function show(AcuerdoCatalogo $acuerdoCatalogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\AcuerdoCatalogo  $acuerdoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function edit(AcuerdoCatalogo $acuerdoCatalogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\AcuerdoCatalogo  $acuerdoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcuerdoCatalogo $acuerdoCatalogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\AcuerdoCatalogo  $acuerdoCatalogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            AcuerdoCatalogo::destroy($request->id);
            return back()->with("notificacion", [ 'icon' => 'success', 'title' => 'Eliminado...', 'text' => 'Elemento elimiando']);
        } catch (\Exception $e) {
            return back()->with("notificacion", [ 'icon' => 'error', 'title' => 'No se pudo eliminar', 'text' => 'Error al eliminar']);
        }
    }
}
