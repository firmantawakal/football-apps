<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'player';
    protected $fillable = [
        'id_club',
        'player_name',
        'birth_place',
        'birth_date',
        'number',
        'position',
        'image',
    ];
}
