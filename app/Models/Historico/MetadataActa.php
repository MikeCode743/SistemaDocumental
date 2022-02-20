<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class MetadataActa extends Model
{
    //
    protected $table = 'gd_metadata_acta';
    protected $fillable = ['numero_acta', 'periodo_gestion'];


    /**
     * Get the post that owns the comment.
     */
    public function temporadaGestion()
    {
        return $this->belongsTo('App\Models\Historico\TemporadaGestion','id_gd_temporada_gestion');
    }


    /**
     * Get the post that owns the comment.
     */
    public function obtenerArchivosActas()
    {
        return $this->hasManyThrough('App\Models\Historico\Archivo', 'App\Models\Historico\DetalleItem','id_gd_metadata_acta','id');
    }
    
}
