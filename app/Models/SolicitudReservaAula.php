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
        "id_aula",
        "id_user",
        "estado",
        "cantidad_estudiantes",
        "observaciones"
    ];
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function aulas()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
    public function periodos()
    {
        return $this->belongsToMany(Periodo::class, 'solicitud_periodos', 'solicitud_reserva_aula_id', 'periodo_id');
    }

}
