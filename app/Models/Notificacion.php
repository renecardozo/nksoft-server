<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = ['id_solicitud','respuesta'];
    protected $table = 'notificacion';

    public function solicitud()
    {
        return $this->belongsTo(SolicitudReservaAula::class, 'id_solicitud');
    }

}
