<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'level',
        'certification',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtenir le profil associé à cette langue.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Obtenir le niveau formaté pour l'affichage.
     */
    public function getLevelFormattedAttribute(): string
    {
        return match($this->level) {
            'debutant' => 'Débutant',
            'elementaire' => 'Élémentaire',
            'intermediaire' => 'Intermédiaire',
            'avance' => 'Avancé',
            'bilingue' => 'Bilingue',
            'langue_maternelle' => 'Langue maternelle',
            default => $this->level,
        };
    }

    /**
     * Scope pour filtrer par niveau.
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Scope pour les langues courantes.
     */
    public function scopeCommon($query)
    {
        return $query->whereIn('name', ['Français', 'Anglais', 'Espagnol', 'Allemand', 'Italien']);
    }
}
