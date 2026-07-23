<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;
    protected $table = 'membership_plans';
    public $timestamps = false;

    public function membershipType() 
    {
        return $this->belongsTo(MembershipType::class, 'membership_type', 'id');
    }

    public function plans()
    {
        return $this->belongsTo(Member::class,'plan_id','id');
    }
}
