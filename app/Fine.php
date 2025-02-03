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
        'vehiclePlateNum',
        'vehicle_type',
        'vehicle_brand',
        'session',
        'nama_pelajar',
        'kod_program',
        'fakulti',
        'kolej',
        'di_kunci_di_saman',
        'dikompaun',
        'compounded_expiration',
        'student_status'
    ];
    protected $casts = [
        'kesalahan' => 'array', // Cast kesalahan to array
        'compounded_expiration' => 'datetime', // Cast compounded_expiration to datetime
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_matricNum', 'matric_number');
    }

    public function sticker()
    {
        return $this->belongsTo(Sticker::class, 'sticker_id', 'unique_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'student_matricNum', 'student_matricNumber');
    }

}

