<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $fillable = [
        'id_season',
        'id_club_a',
        'id_club_b',
        'score_a',
        'score_b',
        'point_a',
        'point_b',
        'isFinish',
        'time'
    ];
}
