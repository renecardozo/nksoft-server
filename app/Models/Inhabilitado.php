<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhabilitado extends Model
{
    use HasFactory;
    protected $fillable = ['aula_id','periodo_id','fecha'];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
