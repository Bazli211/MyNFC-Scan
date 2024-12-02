<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FineStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_matricNumber', 'fine_details', 'fine_date', 'fine_time', 'fine_status'
    ];

    public function fine()
    {
        return $this->belongsTo(Fine::class, 'student_matricNumber', 'student_matricNum');
    }
}
