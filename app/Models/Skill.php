<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'level',
        'category',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
