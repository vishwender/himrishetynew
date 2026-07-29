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

    public function getProfileCompletion()
    {
        $totalFields = 10;
        $completed = 0;

        $fields = [
            $this->full_name,
            $this->email,
            $this->mobile,
            $this->gender,
            $this->height,
            $this->religion,
            $this->horoscope_needed,
            $this->about_my_education,
            $this->education,
            $this->family_type,
            $this->family_status,
            $this->father_name,
            $this->father_occupation
        ];

        foreach ($fields as $field) {
            if (!empty($field)) {
                $completed++;
            }
        }

        return round(($completed / $totalFields) * 100);
    }
}
