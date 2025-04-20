<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\LocaleSwitcher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilePage extends Page implements HasForms, HasActions
{
    use InteractsWithForms, Translatable, InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile-page';

    // Define esto como una propiedad estática para proteger la página
    protected static bool $shouldCheckAccess = true;

    // Comprueba el acceso a la página
    public static function canAccess(): bool
    {
        return Auth::check();
    }

    public string $activeLocale;

    public ?User $record = null;
    public array $data = [];

    public function getTitle(): string|Htmlable
    {
        return __('filament.profile.label');
    }

    public function mount(): void
    {
        $this->activeLocale = $this->activeLocale ?? App::getLocale();

        $this->record = Auth::user();

        if (is_string($this->record->photo)) {
            $this->record->photo = [$this->record->photo];
        }

        $this->data = $this->record->attributesToArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        $locale = $this->activeLocale ?? App::getLocale();

        return $form->schema([
            Section::make(__('filament.profile.title'))
                ->description(__('filament.profile.description'))
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('name')
                                ->label(__('filament.profile.name.label'))
                                ->required(),
                            TextInput::make('email')
                                ->label(__('filament.profile.email.label'))
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                        ]),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('phone')
                                ->label(__('filament.profile.phone.label'))
                                ->tel()
                                ->nullable(),
                            FileUpload::make('photo')
                                ->label(__('filament.profile.avatar.label'))
                                ->avatar() // Estilo de avatar para la imagen
                                ->directory('avatars') // Directorio donde se guardarán las fotos
                                ->nullable()
                                ->multiple(false),
                        ]),
                    TextInput::make("address.{$locale}")
                        ->label(__('filament.profile.address.label'))
                        ->nullable(),
                    Textarea::make("bio.{$locale}")
                        ->label(__('filament.profile.bio.label'))
                        ->nullable(),
                ]),

            Section::make(__('filament.profile.social.title'))
                ->description(__('filament.profile.social.description'))
                ->schema([
                    TextInput::make('github_url')
                        ->label(__('filament.profile.github.label'))
                        ->url()
                        ->nullable(),
                    TextInput::make('x_url')
                        ->label(__('filament.profile.twitter.label'))
                        ->url()
                        ->nullable(),
                    TextInput::make('linkedin_url')
                        ->label(__('filament.profile.linkedin.label'))
                        ->url()
                        ->nullable(),
                ])->columns(3)
        ])->statePath('data');;
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();
        $user->update($data);

        Notification::make()
            ->title(__('filament.profile.notifications.update.success'))
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament.profile.actions.update'))
                ->color('primary')
                ->action('submit')
                ->requiresConfirmation()
                ->successNotificationTitle(__('filament.profile.updated')),
        ];
    }

    protected function getFormModel(): Model|string|null
    {
        return \App\Models\User::class;
    }
}
