<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'appointement_date',
        'patient_id',
        'doctor_id',
    ];

    public function doctor(){
        return $this->belongsTo(User::class ,"doctor_id");
    }
}
