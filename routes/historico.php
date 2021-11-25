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
    Route::get('/', function (Request $request) {
        $periodo_gestion =  CollectionTemporadaGestion::collection(TemporadaGestion::all());
        return view('modulos.historico.crear.acta', compact('periodo_gestion'));
    });
});


Route::prefix('estado-item')->group(function () {
    Route::get('/', 'EstadoItemController@index');
    Route::post('/', 'EstadoItemController@store');
    Route::delete('/eliminar/{id}', 'EstadoItemController@destroy');
});

Route::prefix('tipo-documento')->group(function () {
    Route::get('/', 'TipoDocumentoController@index');
    Route::post('/', 'TipoDocumentoController@store');
    Route::delete('/eliminar/{id}', 'TipoDocumentoController@destroy');
});

Route::prefix('acuerdo')->group(function () {
    Route::get('/', 'AcuerdoCatalogoController@index');
    Route::post('/', 'AcuerdoCatalogoController@store');
    Route::delete('/eliminar/{id}', 'AcuerdoCatalogoController@destroy');
});

Route::prefix('asunto')->group(function () {
    Route::get('/', 'AsuntoCatalogoController@index');
    Route::post('/', 'AsuntoCatalogoController@store');
    Route::delete('/eliminar/{id}', 'AsuntoCatalogoController@destroy');
});

Route::prefix('temporada-gestion')->group(function () {
    Route::get('/', 'TemporadaGestionController@index');
    Route::post('/', 'TemporadaGestionController@store');
    Route::delete('/eliminar/{id}', 'TemporadaGestionController@destroy');
});

Route::prefix('describir-documento')->group(function () {
    Route::get('/', 'DetalleItemController@index');
    Route::post('/acta', 'DetalleItemController@storeActa')->name('agregar.acta');
});
