<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_freelance' => 'boolean',
        ];
    }
}
