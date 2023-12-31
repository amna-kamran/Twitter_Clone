<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['u_id','content','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
