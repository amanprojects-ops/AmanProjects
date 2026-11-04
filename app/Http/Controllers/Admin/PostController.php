<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HtmlPurifier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    use HandlesFileUploads;
    public function index(): View
    {
        $posts = Post::with('categories')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Sanitize HTML content to prevent XSS
        if (isset($data['content'])) {
            $data['content'] = HtmlPurifier::clean($data['content']);
        }

        if ($request->hasFile('featured_image')) {
            try {
                $data['featured_image'] = $this->uploadFile(
                    $request->file('featured_image'),
                    'blogs'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['featured_image' => $e->getMessage()])->withInput();
            }
        }

        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        if (isset($data['categories'])) {
            $post->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        // Sanitize HTML content to prevent XSS
        if (isset($data['content'])) {
            $data['content'] = HtmlPurifier::clean($data['content']);
        }

        if ($request->hasFile('featured_image')) {
            try {
                $data['featured_image'] = $this->uploadFile(
                    $request->file('featured_image'),
                    'blogs',
                    $post->featured_image
                );
            } catch (\Exception $e) {
                return back()->withErrors(['featured_image' => $e->getMessage()])->withInput();
            }
        }

        $post->update($data);

        if (isset($data['categories'])) {
            $post->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->featured_image && str_starts_with($post->featured_image, 'uploads/')) {
            $this->deleteFile($post->featured_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
