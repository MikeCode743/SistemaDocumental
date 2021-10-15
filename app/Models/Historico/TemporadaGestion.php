<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class TemporadaGestion extends Model
{
    protected $table = 'gd_temporada_gestion';
    protected $fillable = ['nombre_rector', 'anio_inicio', 'anio_finalizacion'];
}
