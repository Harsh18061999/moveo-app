<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'purpose',
        'selected_date',
        'sloat_id',
    ];
    
    public function time_solt(){
        return $this->hasOne(TimeSlote::class,'id','sloat_id');
    }
}
