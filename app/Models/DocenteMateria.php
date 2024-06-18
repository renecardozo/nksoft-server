<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia;
class DocenteMateria extends Model
{
    use HasFactory;
    protected $fillable = [
        "docente_id",
        "materia_id",
        "grupo",
    ];
    protected $table = "docente_materia";
    public function materia()
    {
        return $this->hasOne(Materia::class,'id','materia_id');
    }
    public function getById($id)
    {
        try {
            $docenteMateria = DocenteMateria::findOrFail($id);
            return response()->json($docenteMateria, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Docente Materia not found'], 404);
        }
    }
}
