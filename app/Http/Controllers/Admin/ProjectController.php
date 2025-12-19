<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use HandlesFileUploads;
    public function index(): View
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail_image')) {
            try {
                $data['thumbnail_image'] = $this->uploadFile(
                    $request->file('thumbnail_image'),
                    'projects'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['thumbnail_image' => $e->getMessage()])->withInput();
            }
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail_image')) {
            try {
                $data['thumbnail_image'] = $this->uploadFile(
                    $request->file('thumbnail_image'),
                    'projects',
                    $project->thumbnail_image
                );
            } catch (\Exception $e) {
                return back()->withErrors(['thumbnail_image' => $e->getMessage()])->withInput();
            }
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->thumbnail_image && str_starts_with($project->thumbnail_image, 'uploads/')) {
            $this->deleteFile($project->thumbnail_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
