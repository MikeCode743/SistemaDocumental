<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class FormatoDocumento extends Model
{
    //
    protected $table = 'gd_formato_documento';
    protected $fillable = ['nombre', 'descripcion'];
}
