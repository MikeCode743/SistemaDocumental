<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\AsuntoCatalogo;
use Illuminate\Http\Request;

class AsuntoCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AsuntoCatalogo::all();
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
            return $estadoItem;
        } catch (\Exception $e) {
            return $e;
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
            return "eliminado";
        } catch (\Exception $e) {
            return $e;
        }
    }
}
