<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $table = 'followers';

    protected $fillable = [
        'user_id',
        'follower_id',
    ];
}