<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'cod_sis', 'ci'];
    protected $table = 'docente';
}
