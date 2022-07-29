<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'start_end_time',
        'start_time',
        'end_time',
        'status'
    ];
}
