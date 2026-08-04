<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'members';

    protected $guarded = [];

    public $timestamps = false;

    protected $dates = [
        'birth_date_time'
    ];

    // Automatically include these attributes
    protected $appends = [
        'age',
        'profile_completion',
        'wallet_balance'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function photos()
    {
        return $this->hasMany(MemberPhotos::class, 'member_id');
    }

    public function wallet()
    {
        return $this->hasOne(MemberWallet::class, 'member_id')
            ->latestOfMany(); // Latest wallet record
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAgeAttribute()
    {
        if (empty($this->birth_date_time)) {
            return null;
        }

        return Carbon::parse($this->birth_date_time)->age;
    }

    public function getProfileCompletionAttribute()
    {
        $totalFields = 13;
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
            $this->father_occupation,
        ];

        foreach ($fields as $field) {
            if (!empty($field)) {
                $completed++;
            }
        }

        return round(($completed / $totalFields) * 100);
    }

    public function getWalletBalanceAttribute()
    {
        return optional($this->wallet)->wallet_balance ?? 0;
    }
}
