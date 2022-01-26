<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AsuntoCatalogo extends Model
{
    protected $table = 'gd_asunto_catalogo';
    protected $fillable = ['nombre', 'descripcion', 'id_gd_acuerdo_catalogo'];

    /**     
     * Get the acuerdos for the asuntos.
     */

    public function acuerdos()
    {
         return $this->belongsTo('App\Models\Historico\AcuerdoCatalogo', 'id_gd_acuerdo_catalogo');
    }

}
