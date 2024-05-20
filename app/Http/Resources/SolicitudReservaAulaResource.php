<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudReservaAulaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = null;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "fecha_reserva" => Carbon::parse($this->fecha_hora_reserva)->format('m-d-Y'),
            "fecha_solicitud" =>Carbon::parse($this->created_at)->format('m-d-Y'),
            "motivo_reserva" => $this->motivo_reserva,
            "id_materia" => $this->id_materia,
            "id_periodo" => $this->id_horario,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            "id_aula"=> $this->id_aula,
            "id_user"=> $this->id_user,
            "estado"=> $this->estado,
            "cantidad_estudiantes"=> $this->cantidad_estudiantes,
            "observaciones"=> $this->observaciones
        ];
    }
}
