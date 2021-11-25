<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class DetalleItem extends Model
{
    protected $table = 'gd_detalle_archivo';


    protected $fillable = ['id_gd_archivo', 'id_gd_metadata_acta', 'id_gd_metadata_acuerdo'];
}
