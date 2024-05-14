<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudReservaAula extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha_solicitud",
        "motivo_reserva",
        "id_materia",
        "id_horario",
        "aula",
        "fecha_hora_reserva",
    ];
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }

    public function periodos()
    {
        return $this->belongsTo(Periodo::class, 'id_horario');
    }

}
