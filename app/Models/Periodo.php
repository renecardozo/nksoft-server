<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'horaInicio',
        'horaFin',
        'numero_periodo',
    ];
    public function solicitud_reserva_aulas()
    {
        return $this->belongsToMany(SolicitudReservaAula::class, 'solicitud_periodos', 'periodo_id', 'solicitud_reserva_aula_id');
    }
}