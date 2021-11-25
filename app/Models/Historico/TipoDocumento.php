<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'gd_tipo_documento';
    protected $primaryKey = 'nombre_corto';
    protected $fillable = ['nombre_corto', 'nombre', 'descripcion'];
}
