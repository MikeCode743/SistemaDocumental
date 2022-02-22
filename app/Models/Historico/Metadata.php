<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Metadata extends Model
{
    //
    protected $table = 'gd_metadata_acuerdo';




    public function asuntos()
    {
        return $this->belongsToMany('App\Models\Historico\AsuntoCatalogo', 'gd_detalle_asunto', 'id_gd_metadata_acuerdo', 'id_gd_asunto_catalogo');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Historico\EstadoItem', 'id_gd_estado_item');
    }

    public function formato()
    {
        return $this->belongsTo('App\Models\Historico\FormatoDocumento','id_gd_estado_item');
    }

    public function acuerdos($id){
        return DB::table('gd_detalle_asunto')
            ->select(['gd_asunto_catalogo.id', 'gd_asunto_catalogo.nombre', 'gd_asunto_catalogo.descripcion', 'gd_asunto_catalogo.id_gd_acuerdo_catalogo', 'gd_acuerdo_catalogo.nombre as nombre_acuerdo'])
            ->join('gd_asunto_catalogo', 'gd_detalle_asunto.id_gd_asunto_catalogo','gd_asunto_catalogo.id')
            ->join('gd_acuerdo_catalogo', 'gd_asunto_catalogo.id_gd_acuerdo_catalogo','gd_acuerdo_catalogo.id')
            ->where('gd_detalle_asunto.id_gd_metadata_acuerdo', $id)
            ->get();

    }

    public function personasAsociadas()
    {
        return $this->hasMany('App\Models\Historico\PersonaAsociada','id_gd_metadata');
    }
    


}
