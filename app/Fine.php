<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'student_matricNum',
        'sticker_id',
        'fine_date',
        'location',
        'fine_time',
        'comment',
        'kesalahan', // Store JSON
    ];

    // Relationship with User
    public function student()
    {
        return $this->belongsTo(User::class, 'student_matricNum', 'matric_number');
    }

    // Relationship with Sticker
    public function sticker()
    {
        return $this->belongsTo(Sticker::class, 'sticker_id', 'unique_id');
    }

    //Relationship with Vehicle
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'student_matricNumber', 'student_matricNum');
    }

}

