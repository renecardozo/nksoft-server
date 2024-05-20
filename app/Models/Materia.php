<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
   // protected $fillable = ['id_materia','codigo', 'materia', 'grupo', 'docente', 'departamento'];
    protected $fillable = ['id_materia','codigo', 'materia', 'grupo', 'departamento'];
    protected $table = 'materia';

    public function users()
    {
        return $this->belongsToMany(User::class, 'docente_materia', 'materia_id', 'docente_id')->withPivot('grupo');
    }
}
