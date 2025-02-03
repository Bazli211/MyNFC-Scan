<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles'; 

    protected $casts = [
        'sticker_date' => 'date', // This will cast the date field to a Carbon instance
        'roadtax_date' => 'date', // Optionally for roadtax_date too
    ];
    protected $fillable = [
        'vehiclePlateNum',
        'vehicle_type',
        'vehicle_brand',
        'motorcycle_model',
        'car_model',
        'sticker_date',
        'vehicle_color',
        'roadtax_date',
        'student_matricNumber',
        'status_register'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_matricNumber', 'matric_number');
    }
    public function sticker()
    {
        return $this->hasOne(Sticker::class, 'student_matricNumber', 'student_matricNumber');
    }       
    public function isRoadTaxExpired()
    {
        return $this->roadtax_date->isPast();
    }
}

