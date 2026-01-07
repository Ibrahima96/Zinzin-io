<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->get();
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string|max:225',
            'photo' => 'nullable|image|max:3000'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('posts', 'public');
        }

        auth()->user()->posts()->create($data);
        return redirect('/')->with('success', 'Post créée avec succés 👌 ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'message' => 'required|string|max:225',
            'photo' => 'nullable|image|max:3000'
        ]);

        if ($request->hasFile('photo')) {
            if ($post->photo) {
                Storage::disk('public')->delete($post->photo);
            }
            $data['photo'] = $request->file('photo')->store('posts', 'public');
        }

        $post->update($data);
        return redirect('/')->with('success', 'Post modifier avec succés 😎 ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/')->with('success', 'Post supprimée avec succés 😎 ');
    }
}
