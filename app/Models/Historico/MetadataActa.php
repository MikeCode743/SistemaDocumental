<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class MetadataActa extends Model
{
    //
    protected $table = 'gd_metadata_acta';
    protected $fillable = ['numero_acta', 'periodo_gestion'];
}
