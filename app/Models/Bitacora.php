<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora';

    protected $fillable = [
        'timestamp',
        'username',
        'email',
        'role',
        'id_resource',
        'name_resource',
        'actions',
    ];
    
    public function setEventDateAttribute($value)
    {
        $this->attributes['timestamp'] = Carbon::parse($value);
    }
    // public $timestamps = false;
}
