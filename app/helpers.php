<?php

use App\Models\Language;
use Illuminate\Foundation\Application;
use Illuminate\Session\SessionManager;

if (!function_exists('set_locale_session')) {
    function set_locale_session(string $locale = null): void
    {
        if (!$language = Language::whereLanguageCode($locale)->first()) {
            $language = Language::whereIsDefault(true)->first();
        }

        session()->put(Language::LOCALE_SESSION_KEY, $language);
        session()->save();
    }
}

if (!function_exists('set_local_by_session')) {
    function set_local_by_session(): void
    {
        $language = getLanguage();

        app()->setLocale($language->language_code);
        setlocale(LC_TIME, $language->locale_code);
    }
}

if (!function_exists('get_language_code')) {
    function get_language_code(): string
    {
        $language = getLanguage();

        return $language->language_code;
    }
}

if (!function_exists('get_locale_code')) {
    function get_locale_code(): string
    {
        $language = getLanguage();

        return $language->locale_code;
    }
}

if (!function_exists('available_languages')) {
    function available_languages(): \Illuminate\Database\Eloquent\Collection
    {
        return cache()->rememberForever('languages', function () {
            return Language::all();
        });
    }
}

if (!function_exists('storage_image_url')) {
    function storage_image_url(string $path): string
    {
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

/**
 * @return SessionManager|Language|Application|null
 */
function getLanguage(): SessionManager|null|Language|Application
{
    /** @var Language $language */
    if (!$language = session(key: Language::LOCALE_SESSION_KEY)) {
        set_locale_session();
        $language = session(key: Language::LOCALE_SESSION_KEY);
    }
    return $language;
}
