<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 20;

    public static function getNavigationLabel(): string
    {
        return __('filament.resources.projects.label');
    }

    public static function getLabel(): ?string
    {
        return __('filament.resources.projects.label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('filament.resources.projects.form.user_id.label'))
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.resources.projects.form.is_active.label')),
                Forms\Components\TextInput::make('title')
                    ->label(__('filament.resources.projects.form.title.label'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(__('filament.resources.projects.form.description.label'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('url')
                    ->label(__('filament.resources.projects.form.url.label'))
                    ->required()
                    ->url(),
                Forms\Components\TagsInput::make('technologies')
                    ->separator()
                    ->label(__('filament.resources.projects.form.technologies.label'))
                    ->splitKeys(['Tab', ' '])
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label(__('filament.resources.projects.form.start_date.label')),
                Forms\Components\DatePicker::make('end_date')
                    ->label(__('filament.resources.projects.form.end_date.label')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.resources.projects.table.title.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('filament.resources.projects.table.user.label')),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label(__('filament.resources.projects.table.is_active.label')),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('filament.resources.projects.table.url.label'))
                    ->url(fn(Project $record): string => $record->url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('filament.resources.projects.table.start_date.label'))
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label(__('filament.resources.projects.table.end_date.label'))
                    ->date(),
            ])
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
