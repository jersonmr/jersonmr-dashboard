<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    use Translatable;

    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.experience.label');
    }

    public static function getLabel(): ?string
    {
        return __('filament.resources.experience.label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_freelance')
                    ->label(__('filament.resources.experience.form.is_freelancer.label'))
                    ->columnSpanFull(),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('position')
                            ->label(__('filament.resources.experience.form.position.label'))
                            ->required(),
                        Forms\Components\TextInput::make('company')
                            ->label(__('filament.resources.experience.form.company.label'))
                            ->required(),
                        Forms\Components\TextInput::make('company_url')
                            ->label(__('filament.resources.experience.form.company_url.label')),
                    ]),
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label(__('filament.resources.experience.form.start_date.label'))
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label(__('filament.resources.experience.form.end_date.label')),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label(__('filament.resources.experience.form.description.label'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('technologies')
                    ->separator()
                    //                    ->suggestions([
                    //                        'tailwindcss',
                    //                        'alpinejs',
                    //                        'laravel',
                    //                        'livewire',
                    //                        'nestjs',
                    //                        'filament',
                    //                    ])
                    ->splitKeys(['Tab', ' '])
                    ->label(__('filament.resources.experience.form.technologies.label'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('location')
                    ->label(__('filament.resources.experience.form.location.label'))
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label(__('filament.resources.experience.table.position.label')),
                Tables\Columns\TextColumn::make('company')
                    ->label(__('filament.resources.experience.table.company.label'))
            ])
            //            ->recordUrl(
            //                fn (Experience $record): string => $record->company_url ? URL::to($record->company_url) : "#",
            //                shouldOpenInNewTab: true,
            //            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
