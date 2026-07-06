<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use App\Models\Project;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    use HandlesFileUploads;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $albums = Album::with('project')->withCount('images')->orderBy('sort_order')->get();
        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $projects = Project::orderBy('title')->get();
        $album = new Album();
        return view('admin.albums.create', compact('projects', 'album'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:5120',
        ]);

        $data = $request->except('images');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->input('sort_order', 0) ?? 0;

        $album = Album::create($data);

        if ($request->hasFile('images')) {
            $sortOrder = 0;
            foreach ($request->file('images') as $imageFile) {
                try {
                    $path = $this->uploadFile($imageFile, 'albums');
                    AlbumImage::create([
                        'album_id' => $album->id,
                        'image_path' => $path,
                        'sort_order' => $sortOrder++,
                        'is_active' => true,
                    ]);
                } catch (\Exception $e) {
                    // Log or handle individual file failure
                }
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album): View
    {
        $projects = Project::orderBy('title')->get();
        $album->load('images');
        return view('admin.albums.edit', compact('projects', 'album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album): RedirectResponse
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:album_images,id',
        ]);

        $data = $request->except(['images', 'delete_images']);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->input('sort_order', 0) ?? 0;

        $album->update($data);

        // Process deletions of existing images
        if ($request->has('delete_images')) {
            $imagesToDelete = AlbumImage::whereIn('id', $request->input('delete_images'))
                                         ->where('album_id', $album->id)
                                         ->get();
            foreach ($imagesToDelete as $image) {
                if ($image->image_path) {
                    $this->deleteFile($image->image_path);
                }
                $image->delete();
            }
        }

        // Process new images upload
        if ($request->hasFile('images')) {
            // Get current max sort order for this album
            $maxSortOrder = AlbumImage::where('album_id', $album->id)->max('sort_order') ?? -1;
            $sortOrder = $maxSortOrder + 1;

            foreach ($request->file('images') as $imageFile) {
                try {
                    $path = $this->uploadFile($imageFile, 'albums');
                    AlbumImage::create([
                        'album_id' => $album->id,
                        'image_path' => $path,
                        'sort_order' => $sortOrder++,
                        'is_active' => true,
                    ]);
                } catch (\Exception $e) {
                    // Log or handle individual file failure
                }
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album): RedirectResponse
    {
        // Delete all images associated with this album
        foreach ($album->images as $image) {
            if ($image->image_path) {
                $this->deleteFile($image->image_path);
            }
        }

        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }
}
