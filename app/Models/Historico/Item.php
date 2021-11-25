<?php

namespace App\Models\Historico;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'gd_item';
    protected $fillable = ['informacion'];
}
