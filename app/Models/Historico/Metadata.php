<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    //
    protected $table = 'gd_metadata_acuerdo';




    public function asuntos()
    {
        return $this->belongsToMany('App\Models\Historico\AsuntoCatalogo', 'gd_detalle_asunto', 'id_gd_metadata_acuerdo', 'id_gd_asunto_catalogo');
    }
}
