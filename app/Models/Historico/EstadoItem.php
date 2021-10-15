<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class EstadoItem extends Model
{
    protected $table = 'gd_estado_item';
    protected $fillable = ['nombre', 'nombre_corto', 'descripcion', 'is_visible'];
}
