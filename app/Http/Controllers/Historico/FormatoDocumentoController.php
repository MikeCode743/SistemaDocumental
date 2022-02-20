<?php

namespace App\Http\Controllers\Historico;

use App\Models\Historico\FormatoDocumento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormatoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.historico.administrador.formato-documento');

        return FormatoDocumento::all();
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

            $tipoDocumento = FormatoDocumento::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                ]
            );
            return $tipoDocumento;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historico\FormatoDocumento  $formatoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(FormatoDocumento $formatoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\FormatoDocumento  $formatoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(FormatoDocumento $formatoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\FormatoDocumento  $formatoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormatoDocumento $formatoDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\FormatoDocumento  $formatoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            FormatoDocumento::destroy($id);
            return "eliminado";
        } catch (\Exception $e) {
            return $e;
        }
    }
}
