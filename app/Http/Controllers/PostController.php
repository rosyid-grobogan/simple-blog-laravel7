<?php

namespace App\Http\Controllers;

use App\{Post, Category, Tag};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Post::latest()->get();
        //return Post::with('author', 'category', 'tags')->latest()->get();
        return view('posts.index', [
            //'posts' => Post::latest()->paginate(6)
            'posts' => Post::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostRequest $postRequest)
    {
        $attr = $postRequest->all();
        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;

        if (request()->file('thumbnail')) {
            $thumbnailUrl = request()->file('thumbnail')->store('images/posts');
        } else {
            $thumbnailUrl = 'images/posts/no-post.png';
        }
        $thumbnail = request()->file('thumbnail');
        $thumbnailUrl = $thumbnail->store('images/posts');

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnailUrl;

        $post = auth()->user()->posts()->create($attr); // cara d2
        $post->tags()->attach(request('tags'));

        session()->flash('success', 'The post was created');
        return redirect()->to('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(3)->get();
        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $postRequest, Post $post)
    {
        $this->authorize('update', $post);
        // remove image when updated
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnailUrl = request()->file('thumbnail')->store('images/posts');
        } else {
            $thumbnailUrl = $post->thumbnail;
        }

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnailUrl;

        $post->update($attr);
        $post->tags()->sync(request('tags'));
        session()->flash('success', 'The post was updated');

        return redirect()->to('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        // remove image when post is deleted
        \Storage::delete($post->thumbnail);

        $post->tags()->detach();
        $post->delete();
        session()->flash("success", "The post was deleted");
        return redirect('posts');
    }
}
