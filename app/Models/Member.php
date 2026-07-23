<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;


class Member extends \Illuminate\Foundation\Auth\User
{
    use HasFactory, Notifiable;

    protected $table = 'members';   // your custom table
    protected $guarded = [];
    public $timestamps = false;

    // protected $hidden = ['password', 'remember_token'];
    protected $dates = ['birth_date_time'];

    // Accessor to calculate age
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date_time)->age;
    }

    // Relationship with photos
    public function photos()
    {
        return $this->hasMany(MemberPhotos::class, 'member_id');
    }
}

