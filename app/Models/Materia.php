<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    use HasFactory;
    protected $guardered = [];

    public function departamento():BelongsTo{
        return $this->belongsTo(Departamento::class,"");
    }

    public function docentes(): BelongsToMany{
        return $this->belongsToMany(Docente::class,'docente_materia')->withPivot('grupo');
     }
}