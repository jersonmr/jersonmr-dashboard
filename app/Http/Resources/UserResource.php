<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Locale') ?? 'en';

        return [
            'name' => $this->name,
            'email' => $this->email,
            'photo' => config('app.url') . '/' . $this->photo,
            'phone' => $this->phone,
            'address' => $this->getTranslation('address', $locale),
            'bio' => $this->getTranslation('bio', $locale),
            'social_links' => [
                'github_url' => $this->github_url,
                'x_url' => $this->x_url,
                'linkedin_url' => $this->linkedin_url,
            ],

            'projects' => ProjectResource::collection($this->whenLoaded('projects')),

            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences')),
        ];
    }
}
