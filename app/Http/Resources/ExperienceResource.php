<?php

namespace App\Http\Resources;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Experience */
class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = request()->header('Locale') ?? 'en';

        return [
            'id' => $this->id,
            'position' => $this->getTranslation('position', $locale),
            'company' => $this->company,
            'company_url' => $this->company_url,
            'start_date' => $this->start_date->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'is_freelance' => $this->is_freelance,
            'description' => $this->getTranslation('description', $locale),
            'technologies' => $this->technologies,
            'location' => $this->location,

            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
