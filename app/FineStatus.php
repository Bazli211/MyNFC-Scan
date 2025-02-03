<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FineStatus extends Model
{
    protected $fillable = [
        'student_matricNumber', 'fine_details', 'fine_date', 'fine_time', 'fine_status','kesalahan','nama_pelajar','kod_program','kolej','fakulti'
    ];

    protected $casts = [
        'fine_details' => 'array', // Cast fine_details to array
        'kesalahan' => 'array', // Cast kesalahan to array
    ];

    public function fine()
    {
        return $this->belongsTo(Fine::class, 'student_matricNumber', 'student_matricNum');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'student_matricNumber', 'matric_number');
}
}
