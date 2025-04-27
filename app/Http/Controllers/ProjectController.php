<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::query()
            ->select([
                'id',
                'title',
                'description',
                'url',
                'technologies',
            ])
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function store(Request $request)
    {
    }

    public function show(Project $project)
    {
    }

    public function update(Request $request, Project $project)
    {
    }

    public function destroy(Project $project)
    {
    }
}
