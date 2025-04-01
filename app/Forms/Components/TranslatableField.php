<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Tabs;

class TranslatableField extends Field
{
    protected string $view = 'forms.components.translatable-field';

    protected string $fieldType = 'TextInput';
    protected array $fieldOptions = [];

    public function fieldType(string $type): static
    {
        $this->fieldType = $type;

        return $this;
    }

    public function fieldOptions(array $options): static
    {
        $this->fieldOptions = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildComponents(): array
    {
        $tabs = [];

        foreach (config('app.available_locales') as $locale => $name) {
//            /** @var Field $componentClass */
            $componentClass = 'Filament\\Forms\\Components\\' . $this->fieldType;

            if (!class_exists($componentClass)) {
                throw new \InvalidArgumentException("Field type {$this->fieldType} does not exist");
            }

            $field = $componentClass::make("{$this->getName()}.{$locale}")
                ->label(ucfirst($this->getName()) . " ({$name})")
                ->required($locale === app()->getFallbackLocale());

            // Aplicar opciones adicionales
            foreach ($this->fieldOptions as $method => $args) {
                if (method_exists($field, $method)) {
                    $field->{$method}(...$args);
                }
            }

            $tabs[] = Tabs\Tab::make($name)
                ->schema([$field]);
        }

        return [
            Tabs::make('Translations')
                ->tabs($tabs)
                ->columnSpanFull()
        ];
    }
}
