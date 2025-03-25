<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    const LOCALE_SESSION_KEY = 'language';

    const SPANISH = [
        'name' => 'Spanish',
        'language_code' => 'es',
        'locale_code' => 'es_ES',
        'active' => true,
        'is_default' => true,
    ];

    const ENGLISH = [
        'name' => 'English',
        'language_code' => 'en',
        'locale_code' => 'en_US',
        'active' => true,
        'is_default' => false,
    ];

    protected function casts()
    {
        return [
            'active' => 'boolean',
            'is_default' => 'boolean',
        ];
    }
}
