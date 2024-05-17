<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['id_materia','codigo', 'materia', 'grupo', 'docente', 'departamento'];
    protected $table = 'materia';
}