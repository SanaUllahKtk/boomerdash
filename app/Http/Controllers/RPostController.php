<?php

namespace App\Http\Controllers;

use App\Models\RCategory;
use App\Models\RPost;
use App\Models\RPostVote;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = RPost::all();
        $categories = RCategory::pluck('name', 'id')->toArray();
        $users = User::pluck('name', 'id')->toArray();
        return view('frontend.r_posts.index', compact('posts', 'categories', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = RCategory::pluck('name', 'id')->toArray();
        return view('frontend.r_posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_description' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'required',
            'categoryId' => 'required'
            // Add validation rules for dropzone files if required
        ]);

        // Create a new instance of RPost model
        $rPost = new RPost();
        $rPost->title = $request->post_title;
        $rPost->description = $request->post_description;
        $rPost->url = $request->url;
        $rPost->img = $request->file;
        $rPost->user_id = \Auth::user()->id;
        $rPost->r_category_id = $request->categoryId;
        $rPost->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post created successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = RPost::findOrFail($id);
        return view('frontend.r_posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RPost $r_post)
    {
        $categories = RCategory::pluck('name', 'id')->toArray();
        return view('frontend.r_posts.edit', compact('categories', 'r_post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RPost $r_post)
    {
        //
        // Validate the incoming request data
        $request->validate([
            // 'post_title' => 'required|string|max:255',
            // 'post_description' => 'required|string',
            // 'url' => 'nullable|url',
            // 'file' => 'required',
            'categoryId' => 'required'
            // Add validation rules for dropzone files if required
        ]);

        // Create a new instance of RPost model
        $r_post->title = $request->post_title;
        $r_post->description = $request->post_description;
        $r_post->url = $request->url;
        $r_post->img = $request->file;
        $r_post->user_id = \Auth::user()->id;
        $r_post->r_category_id = $request->categoryId;
        $r_post->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RPost $r_post)
    {
        //
        $r_post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function getPosts()
    {
        $posts = RPost::with('r_categories')
            ->withCount(['postVotes' => function ($query) {
                // Count the number of votes made within the last 7 days with a value of 1
                $query->where('created_at', '>', now()->subDays(7))
                    ->where('vote', 1);
            }])
            ->orderBy('post_votes_count', 'desc')
            ->take(10)
            ->get();

        $categories = RCategory::pluck('name', 'id')->toArray();
        $users = User::pluck('name', 'id')->toArray();

        return view('frontend.r_posts.index', compact('posts', 'users', 'categories'));
    }

    public function upVote($id)
    {
        // Check if the user is authenticated
        if (\Auth::check()) {
            // Retrieve the RPostVote record for the given post ID and the current user
            $postVote = RPostVote::where('r_post_id', $id)
                ->where('r_user_id', \Auth::user()->id)
                ->where('vote', 1)
                ->first();

            // Check if the record exists
            if ($postVote) {
                $postVote->delete();
            } else {
                $postVote = new RPostVote();
                $postVote->r_user_id = \Auth::user()->id;
                $postVote->r_post_id = $id;
                $postVote->vote = 1;
                $postVote->save();
            }
        } else {
        }

        $totalUpVote = RPostVote::where('r_post_id', $id)
            ->count();

        return json_encode([
            'status' => 'success',
            'total' => $totalUpVote
        ]);
    }


    public function downVote($id)
    {
        // Check if the user is authenticated
        if (\Auth::check()) {
            // Retrieve the RPostVote record for the given post ID and the current user
            $postVote = RPostVote::where('r_post_id', $id)
                ->where('r_user_id', \Auth::user()->id)
                ->where('vote', 0)
                ->first();

            // Check if the record exists
            if ($postVote) {
                $postVote->delete();
            } else {
                $postVote = new RPostVote();
                $postVote->r_user_id = \Auth::user()->id;
                $postVote->r_post_id = $id;
                $postVote->vote = 0;
                $postVote->save();
            }
        } else {
        }

        $totalUpVote = RPostVote::where('r_post_id', $id)
            ->count();

        return json_encode([
            'status' => 'success',
            'total' => $totalUpVote
        ]);
    }

    public function adminPosts(){
        $posts = RPost::all();
        $categories = RCategory::pluck('name', 'id')->toArray();
        $users = User::pluck('name', 'id')->toArray();
        return view('backend.r_posts.index', compact('posts', 'categories', 'users'));        
    }
}
