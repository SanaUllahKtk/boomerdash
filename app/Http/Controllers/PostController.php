<?php

namespace App\Http\Controllers;

use App\Models\ClubPoint;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('backend.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // echo "<pre>";
        // print_r($request->input());
        // die();

        $new = new Post();
        $new->user_id = \Auth::user()->id;
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->content = $request->description;
        $new->type = $request->type;
        $new->status = 1;
        $new->photo = $request->photos;
        $new->timer = $request->timer;
        $new->points = $request->points;
        
        if ($request->has('videolink')) {
            $video = $request->file('videolink');
            $video_extenstion = strtolower($video->getClientOriginalExtension());
            $allow_extentions = array('mp4', 'webm');
            if (!in_array($video_extenstion, $allow_extentions)) {
                flash(translate('Video format is not allowed only MP4 is allowed format'))->error();
                return redirect()->back();
                //return redirect()->back()->withErrors(['msg' => 'Video format is not allowed only MP4 is allowed format']);
            }
            $filename = '_'.time().rand(11111,9999). '.';
            $video_path = $filename.$video_extenstion;
            $video_url = $video->move('public/uploads/video/', $video_path);
            $new->video = $video_url;
        }
        
        $new->published_at = date('Y-m-d h:i:s');
        $new->created_at = date('Y-m-d h:i:s');
        $new->updated_at = date('Y-m-d h:i:s');
        $new->save();

        flash(translate('Post created successfully.'))->success();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('backend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $new = Post::findOrFail($id);
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->content = $request->description;
        $new->status = 1;
        $new->photo = $request->photos;
        $new->timer = $request->timer;
        $new->points = $request->points;
        
        if ($request->has('videolink')) {
            $video = $request->file('videolink');
            $video_extenstion = strtolower($video->getClientOriginalExtension());
            $allow_extentions = array('mp4', 'webm');
            if (!in_array($video_extenstion, $allow_extentions)) {
                flash(translate('Video format is not allowed only MP4 is allowed format'))->error();
                return redirect()->back();
                //return redirect()->back()->withErrors(['msg' => 'Video format is not allowed only MP4 is allowed format']);
            }
            $filename = '_'.time().rand(11111,9999). '.';
            $video_path = $filename.$video_extenstion;
            $video_url = $video->move('public/uploads/video/', $video_path);
            $new->video = $video_url;
        }
        
        $new->updated_at = date('Y-m-d h:i:s');
        $new->save();

        flash(translate('Post updated successfully.'))->success();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::findOrFail($id)->delete();
        return 1;
    }

    public function allPosts(){
        $posts = Post::get();
        $products = Product::get();

        return view('newf.posts', compact('posts', 'products'));
    }

    public function singlePost($id){
        $post = Post::findOrFail($id);
        $posts = Post::get();
        return view('newf.post', compact('post', 'posts'));
    }

    public function savePoints(Request $request){
       $point = new ClubPoint();
       $point->user_id = \Auth::user()->id;
       $point->point_type = 'Blog Reading';
       $point->points = $request->points;
       $point->order_id = 'b'.time();
       $point->convert_status = 0;
       $point->created_at = date('Y-m-d h:i:s');
       $point->updated_at = date('Y-m-d h:i:s');
       $point->save();

       return 1;
    }
}
