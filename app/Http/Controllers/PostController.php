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
        return view('posts.index', [
            'posts' => Post::latest()->paginate(6)
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
    //public function store()
    {
        //dd(request('tags'));
        $attr = $postRequest->all();
        $attr['slug'] = \Str::slug(request('title'));
        $attr['category_id'] = request('category');
        // $attr['user_id'] = auth()->id(); // cara 1
        $attr['thumbnail'] = 'user.png';

        //dd($attr);
        // $post = Post::create($attr);
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
        return view('posts.show', compact('post'));
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
        $attr = $postRequest->all();
        $attr['category_id'] = request('category');
        $attr['user_id'] = auth()->id();

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
        // if (auth()->user()->is($post->author())) {
            $post->tags()->detach();
            $post->delete();
            session()->flash("success", "The post was deleted");
            return redirect('posts');
        // } else {
        //     session()->flash("error", "It wasn't your post");
        //     return redirect('posts');
        // }

    }
}
