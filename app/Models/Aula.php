<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aula extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'unidad_id', 'nombreAulas', 'capacidadAulas'
        ];

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    public function inhabilitados()
    {
        return $this->hasMany(Inhabilitado::class);
    }
}