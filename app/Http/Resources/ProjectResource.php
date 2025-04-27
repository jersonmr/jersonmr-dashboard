<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Locale') ?? 'en';

        return [
            'id' => $this->id,
            'is_active' => $this->is_active,
            'title' => $this->title,
            'description' => $this->getTranslation('description', $locale),
            'url' => $this->url,
            'technologies' => explode(',', $this->technologies),
        ];
    }
}
