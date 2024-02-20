<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
