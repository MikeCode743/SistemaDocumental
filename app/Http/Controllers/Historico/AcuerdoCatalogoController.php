<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\AcuerdoCatalogo;
use Illuminate\Http\Request;

class AcuerdoCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcuerdoCatalogo::all();
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

            $estadoItem = AcuerdoCatalogo::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
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
    public function destroy($id)
    {
        try {
            AcuerdoCatalogo::destroy($id);
            return "eliminado";
        } catch (\Exception $e) {
            return $e;
        }
    }
}
