<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\TemporadaGestion;
use Illuminate\Http\Request;

class TemporadaGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TemporadaGestion::all();
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

            $estadoItem = TemporadaGestion::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre_rector' => $request->nombre_rector,
                    'anio_inicio' => $request->anio_inicio,
                    'anio_finalizacion' => $request->anio_finalizacion,
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
     * @param  \App\Models\Historico\TemporadaGestion  $temporadaGestion
     * @return \Illuminate\Http\Response
     */
    public function show(TemporadaGestion $temporadaGestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\TemporadaGestion  $temporadaGestion
     * @return \Illuminate\Http\Response
     */
    public function edit(TemporadaGestion $temporadaGestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\TemporadaGestion  $temporadaGestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemporadaGestion $temporadaGestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\TemporadaGestion  $temporadaGestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            TemporadaGestion::destroy($id);
            return "eliminado";
        } catch (\Exception $e) {
            return $e;
        }
    }
}
