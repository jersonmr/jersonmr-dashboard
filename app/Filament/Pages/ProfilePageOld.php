<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\LocaleSwitcher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilePageOld extends Page implements HasForms, HasActions
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

    public array $data = [];

    public function getTitle(): string | Htmlable
    {
        return __('filament.profile.label');
    }

    public function mount($activeLocale): void
    {
        $this->activeLocale = $activeLocale;

        $this->form->fill(Auth::user()->attributesToArray());
    }

//    public function mount(): void
//    {
//        abort_unless(Auth::check(), 403);
//
//        $this->activeLocale = $this->activeLocale ?? App::getLocale();
//
//        $userData = Auth::user()->attributesToArray();
//
//        // Extraer el nombre de usuario de GitHub URL si existe
//        if (!empty($userData['github_url']) && is_string($userData['github_url']) && str_contains($userData['github_url'], 'github.com/')) {
//            $userData['github_username'] = str_replace('https://github.com/', '', $userData['github_url']);
//        } else {
//            $userData['github_username'] = '';
//        }
//
//        // Asegúrate de que photo sea un array si existe, o un array vacío si no existe
////        if (isset($userData['photo'])) {
////            if (is_string($userData['photo'])) {
////                $userData['photo'] = [$userData['photo']];
////            } elseif (!is_array($userData['photo'])) {
////                $userData['photo'] = [];
////            }
////        } else {
////            $userData['photo'] = [];
////        }
//
//        $this->data = $userData;
//    }

    public function form(Form $form): Form
    {
        $locale = $this->activeLocale ?? App::getLocale();

        return $form->schema([
            FileUpload::make('photo')
                ->label(__('filament.profile.avatar.label'))
                ->image()
                ->directory('avatars')
                // ->avatar()
                ->disk('public')
                ->visibility('public'),
            Grid::make(3)
                ->schema([
                    TextInput::make('name')
                        ->label(__('filament.profile.name.label'))
                        ->autofocus()
                        ->required(),
                    TextInput::make('email')
                        ->label(__('filament.profile.email.label'))
                        ->required()
                        ->email()
                        ->rules([Rule::unique('users', 'email')->ignoreModel(Auth::user())]),
                    TextInput::make('phone')
                        ->label(__('filament.profile.phone.label')),
                ]),
            TextInput::make("address.{$locale}")
                ->label(__('filament.profile.address.label')),
            Textarea::make("bio.{$locale}")
                ->label(__('filament.profile.bio.label')),
            Grid::make(3)
                ->schema([
                    TextInput::make('github_username')
                        ->label('GitHub')
                        ->prefix('https://github.com/')
                        ->prefixIcon('heroicon-o-academic-cap'),
                    TextInput::make('x_url')
                        ->label('X-Twitter'),
                    TextInput::make('linkedin_url')
                        ->label('LinkedIn'),
                ]),
        ])
            ->statePath('data');
    }

    protected function getActions(): array
    {
        return [];
    }

    // Método para guardar directamente
    public function saveProfile()
    {
        try {
            // Trabajamos directamente con $this->data en lugar de usar getState()
            $data = $this->data;

            // Manejar especialmente el campo de GitHub para construir la URL completa
            if (isset($data['github_username'])) {
                $data['github_url'] = !empty($data['github_username'])
                    ? "https://github.com/{$data['github_username']}"
                    : null;
                unset($data['github_username']);  // Eliminar el campo temporal
            }

            if (isset($data['photo']) && is_array($data['photo'])) {
                $data['photo'] = $data['photo'][0] ?? null;
            }

            Auth::user()->update($data);

            Notification::make()
                ->title(__('filament.profile.updated'))
                ->success()
                ->send();

            return redirect()->back();
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title(__('filament.profile.update_failed'))
                ->danger()
                ->body($e->getMessage())
                ->send();

            return null;
        }
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament.profile.actions.update'))
                ->color('primary')
                ->action('saveProfile')
                ->requiresConfirmation()
                ->successNotificationTitle(__('filament.profile.updated')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    // Necesario para evitar el error de get_class con null
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
