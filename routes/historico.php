<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
// Route::get('/estado-item', function () {
//     return view('welcome');
// });
use Illuminate\Http\Request;
use App\Models\Historico\TemporadaGestion;
use App\Http\Resources\Historico\TemporadaGestion as CollectionTemporadaGestion;


Route::prefix('acta')->group(function () {
    Route::get('/crear', function (Request $request) {
        $periodo_gestion =  CollectionTemporadaGestion::collection(TemporadaGestion::all());
        return view('modulos.historico.crear.acta', compact('periodo_gestion'));
    });

    Route::get('/listado', function (Request $request) {
        return view('modulos.historico.listado.acta');
    });

    Route::get('/listado/detalle/{id}', function ($id) {
        return view('modulos.historico.components.items-acta');
    });
    Route::post('/buscar', 'MetadataActaController@buscar');
    Route::post('/obtener', 'MetadataActaController@obtenerActa');

    Route::get('/listado/temporada', 'MetadataActaController@obtenerActaPorTemporada');
});



Route::prefix('estado-item')->group(function () {
    Route::get('/', 'EstadoItemController@index');
    Route::post('/', 'EstadoItemController@store');
    Route::delete('/eliminar/{id}', 'EstadoItemController@destroy');
});

Route::prefix('acuerdo')->group(function () {
    Route::post('/buscar', 'MetadataController@buscar');
    Route::post('/obtener', 'MetadataController@obtenerAcuerdo');
    Route::get('/crear', function (Request $request) {
        return view('modulos.historico.crear.acuerdo');
    });
    Route::get('/listado', function (Request $request) {
        return view('modulos.historico.listado.acuerdo');
    });

    Route::get('/listado/detalle/{id}', function ($id) {
        return view('modulos.historico.components.items-acuerdo');
    });

    Route::get('/listado/detalle-archivo/{id}', function ($id) {
        return view('modulos.historico.components.detalle-archivo-acuerdo');
    });
});

Route::prefix('acuerdo')->group(function () {
    Route::get('/', 'AcuerdoCatalogoController@index');
    Route::post('/', 'AcuerdoCatalogoController@store');
    Route::post('/eliminar', 'AcuerdoCatalogoController@destroy');
});

Route::prefix('asunto')->group(function () {
    Route::get('/', 'AsuntoCatalogoController@index');
    Route::post('/', 'AsuntoCatalogoController@store');
    Route::post('/eliminar/{id}', 'AsuntoCatalogoController@destroy');
});

Route::prefix('estado-item')->group(function () {
    Route::get('/', 'EstadoItemController@index');
    Route::post('/', 'EstadoItemController@store');
    Route::post('/eliminar/{id}', 'EstadoItemController@destroy');
});

Route::prefix('formato-documento')->group(function () {
    Route::get('/', 'FormatoDocumentoController@index');
    Route::post('/', 'FormatoDocumentoController@store');
    Route::delete('/eliminar/{id}', 'FormatoDocumentoController@destroy');
});

Route::prefix('temporada-gestion')->group(function () {
    Route::get('/', 'TemporadaGestionController@index');
    Route::post('/', 'TemporadaGestionController@store');
    Route::delete('/eliminar/{id}', 'TemporadaGestionController@destroy');
});

Route::prefix('describir-documento')->group(function () {
    Route::get('/', 'DetalleItemController@index');
    Route::post('/acta', 'DetalleItemController@storeActa')->name('agregar.acta');
    Route::post('/acuerdo', 'DetalleItemController@storeAcuerdo')->name('agregar.acuerdo');
});
