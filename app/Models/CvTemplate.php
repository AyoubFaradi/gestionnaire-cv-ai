<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'style',
        'description',
        'options',
        'is_default',
        'is_active',
        'preview_image',
    ];

    protected $casts = [
        'options' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtenir les templates actifs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Obtenir le template par défaut.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Obtenir l'URL de l'image de prévisualisation.
     */
    public function getPreviewUrlAttribute(): string
    {
        return $this->preview_image ? asset('storage/templates/' . $this->preview_image) : '';
    }

    /**
     * Obtenir les options par défaut.
     */
    public static function getDefaultOptions(): array
    {
        return [
            'colors' => ['#1f2937', '#374151', '#6b7280'],
            'fonts' => ['Arial', 'Times New Roman', 'Calibri'],
            'sections' => ['experience', 'formation', 'competence', 'langue'],
        ];
    }
}
