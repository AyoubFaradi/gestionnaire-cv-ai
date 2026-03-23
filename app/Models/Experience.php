<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'poste',
        'entreprise',
        'description',
        'date_debut',
        'date_fin',
        'actuel',
        'lieu',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'actuel' => 'boolean',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
