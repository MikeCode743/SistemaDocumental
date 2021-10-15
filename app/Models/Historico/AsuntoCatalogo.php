<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class AsuntoCatalogo extends Model
{
    protected $table = 'gd_asunto_catalogo';
    protected $fillable = ['nombre', 'descripcion', 'id_gd_acuerdo_catalogo'];
}
