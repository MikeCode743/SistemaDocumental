<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico\EtadoItem;
use Illuminate\Http\Request;

class EtadoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(EtadoItem::all());
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
     * @param  \App\Models\Historico\EtadoItem  $etadoItem
     * @return \Illuminate\Http\Response
     */
    public function show(EtadoItem $etadoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historico\EtadoItem  $etadoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(EtadoItem $etadoItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historico\EtadoItem  $etadoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtadoItem $etadoItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historico\EtadoItem  $etadoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtadoItem $etadoItem)
    {
        //
    }
}
