<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'gd_archivo';
    protected $fillable = ['nombre', 'ruta_almacenado', 'tipo_mime', 'espacio_disco', 'num_version'];
}
