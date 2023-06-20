<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $table = 'following'; // Assuming the table name is 'followings'

    protected $fillable = [
        'user_id',
        'following_id',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
