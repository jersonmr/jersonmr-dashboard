<?php

namespace App\Trait\Models;

trait HasTranslations
{
    public function getAttribute($key): mixed
    {
        return match (true) {
            method_exists($this, $key),
            ! isset($this->translatable),
            ! in_array($key, $this->translatable) => $this->getTranslations($key),
            default => $this->getTranslation($key),
        };
    }

    public function setAttribute($key, $value): static
    {
        return match (true) {
            method_exists($this, $key),
            ! isset($this->translatable),
            ! in_array($key, $this->translatable) => parent::setAttribute($key, $value),
            default => is_array($value)
                ? $this->setTranslations($key, $value)
                : $this->setTranslation($key, $value),
        };
    }

    public function getTranslation(string $key, string $locale = null, bool $withDefault = true): mixed
    {
        $translations = (array) $this->getTranslations($key);

        return data_get(
            target: $translations,
            key: $locale ?? app()->getLocale(),
            default: $withDefault ? $translations[app()->getFallbackLocale()] : null,
        );
    }

    public function getTranslations(string $key): ?array
    {
        return parent::getAttribute($key);
    }

    public function setTranslation(string $key, string $value, string $locale = null): static
    {
        $translations = (array) $this->getTranslations($key);

        $translations[$locale ?? app()->getLocale()] = $value;

        return parent::setAttribute($key, $translations);
    }

    public function setTranslations(string $key, array $translations): static
    {
        foreach ($translations as $locale => $translation) {
            $this->setTranslation($key, $translation, $locale);
        }

        return parent::setAttribute($key, $translations);
    }

    public function forgetTranslation(string $key, string $locale): static
    {
        $translations = (array) $this->getTranslations($key);

        unset($translations[$locale]);

        return parent::setAttribute($key, $translations);
    }
}
