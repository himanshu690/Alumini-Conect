<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        
        $query = Post::with(['user.alumniProfile', 'comments'])->orderBy('created_at', 'desc');

        if ($category && in_array($category, ['Careers', 'Reunions', 'Q&A', 'General'])) {
            $query->where('category', $category);
        }

        $posts = $query->get();
        return view('posts.index', compact('posts', 'category'));
    }

    public function show(Post $post)
    {
        $post->load(['user.alumniProfile', 'comments.user.alumniProfile']);
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:General,Careers,Reunions,Q&A',
        ]);

        Auth::user()->posts()->create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post published successfully!');
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }
}
