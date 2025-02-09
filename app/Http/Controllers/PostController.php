<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category_id' => ['required'],
        ]);
        $post = new Post();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $filename = time() . '-' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('posts', $filename);
        $post->image = '/storage/' . $filePath;
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post = Post::findOrFail($post->id);
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);
        $post = Post::findOrFail($post->id);
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->description = $request->description;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
            ]);

            $filename = time() . '-' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('posts', $filename);
            File::delete(public_path($post->image));
            $post->image = '/storage/' . $filePath;
        }
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function trash(Post $post) {
        $posts = Post::onlyTrashed()->get();
        return view('posts.trash', compact('posts'));
    }
    public function restore($post) {
        $post = Post::onlyTrashed()->findOrFail($post);
        $post->restore();
        return redirect()->route('posts.index');
    }
    public function forceDelete($post) {
        $post = Post::onlyTrashed()->findOrFail($post);
        File::delete(public_path($post->image));
        $post->forceDelete();
        return redirect()->route('posts.trash');
    }

}
