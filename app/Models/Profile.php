<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'phone',
        'address',
        'linkedin',
        'github',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtenir l'utilisateur associé à ce profil.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir les expériences associées à ce profil.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->orderBy('ordre');
    }

    /**
     * Obtenir les formations associées à ce profil.
     */
    public function formations(): HasMany
    {
        return $this->hasMany(Formation::class);
    }

    /**
     * Obtenir les compétences associées à ce profil.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Obtenir les langues associées à ce profil.
     */
    public function languages(): HasMany
    {
        return $this->hasMany(Language::class);
    }

    /**
     * Obtenir le profil complet avec toutes les relations.
     */
    public function getCompleteProfileAttribute()
    {
        return [
            'user' => $this->user,
            'experiences' => $this->experiences,
            'formations' => $this->formations,
            'skills' => $this->skills,
            'languages' => $this->languages,
        ];
    }
}
