<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class AcuerdoCatalogo extends Model
{
    protected $table = 'gd_acuerdo_catalogo';
    protected $fillable = ['nombre', 'descripcion'];
}
