<?php

namespace App\Http\Controllers\Historico;

// use App\Models\MetadataActa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Historico\MetadataActa;
use App\Models\Historico\TemporadaGestion;

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
    public function show(MetadataActa $metadataActa)
    {
        //
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
