<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\EstadoItem;
use Illuminate\Http\Request;

class EstadoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EstadoItem::all();
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

            $estadoItem = EstadoItem::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre' => $request->nombre,
                    'nombre_corto' => $request->nombre_corto,
                    'descripcion' => $request->descripcion,
                    'is_visible' => $request->is_visible,
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
     * @param  \App\Models\Historico\EstadoItem  $estadoItem
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoItem $estadoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\EstadoItem  $estadoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoItem $estadoItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\EstadoItem  $estadoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoItem $estadoItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            EstadoItem::destroy($id);
            return "eliminado";
        } catch (\Exception $e) {
            return $e;
        }
    }
}
