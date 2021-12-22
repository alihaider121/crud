<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::with(['user','likes','comments'])->orderby('created_at','asc')->get();
        // dd($data);

        return view('post.index',compact('data'));
    }


    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $post=Post::create(['description'=>$request->description,'user_id'=>Auth::user()->id]);
        return ($post)?  redirect()->route('posts.index')
        ->with('success','Post created successfully.'):redirect()->route('posts.index')
        ->with('error','Post does not  successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
