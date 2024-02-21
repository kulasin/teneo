<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{   protected $table = 'reg_archive';
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'user_id',
        // Add other fillable columns here
    ];

    
}
