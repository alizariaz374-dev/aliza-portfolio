<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return Project::orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image_url' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'tech_stack' => 'sometimes|required|string',
            'live_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image_url' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, 204);
    }
}