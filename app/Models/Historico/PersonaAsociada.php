<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class PersonaAsociada extends Model
{
    //
    protected $table = 'gd_persona_asociada';
    protected $fillable = ['remitente', 'beneficiario'];
}
