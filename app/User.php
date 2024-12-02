<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'matric_number', 'staff_id','kod_program','fakulti','kolej'
    ];
    public function sticker()
    {
        return $this->hasOne(Sticker::class, 'student_matricNumber', 'matric_number');
    }
    
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'student_matricNumber', 'matric_number');
    }
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
