<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'description',
        'location',
        'contract_type',
        'salary_min',
        'salary_max',
        'date_limite',
        'contact_email',
        'active',
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'date_limite' => 'date',
        'active' => 'boolean',
    ];
}
