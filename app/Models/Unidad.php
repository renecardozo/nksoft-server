<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    use HasFactory;

    protected $fillable = ['departamento_id','nombreUnidades', 'ubicacionUnidades', 
    'horaAperturaUnidades', 'horaCierreUnidades'
    ];

    public function departamento(){
        return $this->belongsTo(Departamento::class)->withDefault();
    }

    public function aula():HasMany{
        return $this->hasMany(Aula::class);
    }

}
