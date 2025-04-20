<x-filament-panels::page>
    <div class="flex justify-end mb-4">
        <x-filament::button wire:click="generateCV">
            Generar CV
        </x-filament::button>
    </div>

    <x-filament-panels::form>
        {{ $this->form }}

        <x-filament::card>
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Experiencia Profesional</h3>

                @forelse($this->record->experiences as $experience)
                    <x-filament::card class="mb-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-base font-medium">
                                    {{ $experience->getTranslation('position', $this->activeLocale) }}
                                </h4>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <span>{{ $experience->company }}</span>
                                    @if($experience->company_url)
                                        <span>•</span>
                                        <a href="{{ $experience->company_url }}" target="_blank" class="text-primary-600 hover:underline">
                                            {{ $experience->company_url }}
                                        </a>
                                    @endif
                                </div>
                                <div class="mt-1 text-xs">
                                    <span>{{ $experience->start_date->format('M Y') }} - {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Presente' }}</span>
                                    @if($experience->location)
                                        <span class="mx-1">•</span>
                                        <span>{{ $experience->location }}</span>
                                    @endif
                                    @if($experience->is_freelance)
                                        <span class="mx-1">•</span>
                                        <x-filament::badge>Freelance</x-filament::badge>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($experience->description)
                            <div class="mt-3 prose-sm max-w-none">
                                {!! nl2br(e($experience->getTranslation('description', $this->activeLocale))) !!}
                            </div>
                        @endif

                        @if($experience->technologies)
                            <div class="mt-3 flex flex-wrap gap-1">
                                @foreach(explode(',', $experience->technologies) as $tech)
                                    <x-filament::badge color="gray">{{ trim($tech) }}</x-filament::badge>
                                @endforeach
                            </div>
                        @endif
                    </x-filament::card>
                @empty
                    <x-filament::card class="mt-4">
                        <div class="text-center py-4 text-gray-500">
                            <p>No hay experiencias registradas</p>
                        </div>
                    </x-filament::card>
                @endforelse
            </div>
        </x-filament::card>

        <x-filament::card class="mt-6">
            <div class="mt-6 mb-4">
                <h3 class="text-lg font-semibold">Proyectos destacados</h3>

                @forelse($this->record->projects as $project)
                    <x-filament::card class="mb-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-base font-medium">
                                    {{ $project->getTranslation('title', $this->activeLocale) }}
                                </h4>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="text-primary-600 hover:underline">
                                            {{ $project->url }}
                                        </a>
                                    @endif
                                    @if(!$project->is_active)
                                        <span class="mx-1">•</span>
                                        <x-filament::badge color="gray">Inactivo</x-filament::badge>
                                    @endif
                                </div>
                                <div class="mt-1 text-xs">
                                    <span>{{ $project->start_date ? $project->start_date->format('M Y') : '' }} - {{ $project->end_date ? $project->end_date->format('M Y') : 'Presente' }}</span>
                                </div>
                            </div>
                        </div>

                        @if($project->description)
                            <div class="mt-3 prose-sm max-w-none">
                                {!! nl2br(e($project->getTranslation('description', $this->activeLocale))) !!}
                            </div>
                        @endif

                        @if($project->technologies)
                            <div class="mt-3 flex flex-wrap gap-1">
                                @foreach(explode(',', $project->technologies) as $tech)
                                    <x-filament::badge color="gray">{{ trim($tech) }}</x-filament::badge>
                                @endforeach
                            </div>
                        @endif
                    </x-filament::card>
                @empty
                    <x-filament::card class="mt-4">
                        <div class="text-center py-4 text-gray-500">
                            <p>No hay proyectos registrados</p>
                        </div>
                    </x-filament::card>
                @endforelse
            </div>
        </x-filament::card>

        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>


    <x-filament-actions::actions />

    <x-filament-actions::modals />
</x-filament-panels::page>
