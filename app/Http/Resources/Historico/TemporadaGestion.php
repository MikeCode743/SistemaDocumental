<?php

namespace App\Http\Resources\Historico;

use Illuminate\Http\Resources\Json\JsonResource;

class TemporadaGestion extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'temporada' => substr($this->anio_inicio, 0, 4) . ' - ' . substr($this->anio_finalizacion, 0, 4),
        ];
    }
}
