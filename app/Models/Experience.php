<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Experience extends Model
{
    use HasTranslations;
    protected $fillable = [
        'user_id',
        'position',
        'company',
        'start_date',
        'end_date',
        'is_freelance',
        'description',
        'technologies',
        'location',
    ];

    protected array $translatable = [
        'position',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'json',
            'description' => 'json',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_freelance' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
