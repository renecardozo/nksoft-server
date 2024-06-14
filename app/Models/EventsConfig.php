<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsConfig extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's naming convention
    protected $table = 'events_config';

    // Specify the primary key if it is not 'id'
    protected $primaryKey = 'id';

    // Specify the properties that are mass assignable
    protected $fillable = [
        'name',
        'code',
        'color',
        'hex_color',
    ];

    // Specify any attributes that should be cast to a specific type
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
        'color' => 'string',
        'hex_color' => 'string',
    ];
}
