<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    
    protected $fillable = ['referral_id','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
