<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class AcuerdoCatalogo extends Model
{
    protected $table = 'gd_acuerdo_catalogo';
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * Get the asuntos for the acuerdos.
     */
    public function asuntos()
    {
        return $this->hasMany('App\Models\Historico\AsuntoCatalogo', 'id_gd_acuerdo_catalogo');
    }
}
