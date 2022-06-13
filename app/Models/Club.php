<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $table = 'club';
    protected $fillable = [
        'club_name',
        'stadium',
        'coach',
        'image'
    ];
}
