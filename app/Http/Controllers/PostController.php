<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\ClubPoint;
use App\Models\Post;
use App\Models\Product;
use App\Models\UserReaderPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $categories = getBlogCategory();

        return view('backend.posts.create', compact('categories'));
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

        // Validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug', // Assuming 'posts' is your table name
            'description' => 'required',
            'category_id' => 'required',
        ];

        // Custom error messages
        $messages = [
            'slug.unique' => 'The slug must be unique.', // Custom message for uniqueness validation
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            flash(translate($validator->errors()->first()))->error();
            return redirect()->back();
        }
         

        // If validation passes, proceed with further processing


        $new = new Post();
        $new->user_id = \Auth::user()->id;
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->content = $request->description;
        $new->type = $request->type;
        $new->category_id = $request->category_id;
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
        $categories = getBlogCategory();
        return view('backend.posts.edit', compact('post', 'categories'));
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
        $new->type = $request->type;
        $new->content = $request->description;
        $new->status = 1;
        $new->photo = $request->photos;
        $new->timer = $request->timer;
        $new->category_id = $request->category_id;
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

    public function allPosts(Request $request){
        $page = \App\Models\PostPage::first();
        $postsQuery = Post::select(['posts.*'])->whereNull('posts.type');

        if (request()->has('cat_id')) {
            $postsQuery->where('category_id', $request->cat_id);
        }
        $posts = $postsQuery->get();


        $latestpostQuery = Post::select(['posts.*'])->whereNotNull('posts.type');

        if (request()->has('cat_id')) {
            $latestpostQuery->where('category_id', $request->cat_id);
        }
        $latest_posts = $latestpostQuery->get();

        $products = Product::get();
        $ads = Ad::where('status', 'active')->paginate(3);
        $categories = getBlogCategory();

        return view('newf.posts', compact('posts', 'page' ,'latest_posts' ,'products', 'ads', 'categories'));
    }

    public function singlePost($id){
        $post = Post::where('slug', $id)->first();
        $posts = Post::select(['posts.*'])->leftJoin('user_reader_posts', 'user_reader_posts.post_id', '=', 'posts.id')
        ->whereNull('posts.type')
        ->whereNull('user_reader_posts.post_id')
        ->get();

        $ads = Ad::where('status', 'active')->paginate(3);

        return view('newf.post', compact('post', 'posts', 'ads'));
    }


    public function singlePostForMobile($id){
        $post = Post::where('slug', $id)->first();
        $posts = Post::select(['posts.*'])->whereNull('posts.type')
        ->get();
        return view('frontend.post', compact('post', 'posts'));
    }

    public function allPostsForMobile(Request $request){
        $page = \App\Models\PostPage::first();
        $postsQuery = Post::select(['posts.*'])->whereNull('posts.type');

        if (request()->has('cat_id')) {
            $postsQuery->where('category_id', $request->cat_id);
        }
        $posts = $postsQuery->get();


        $latestpostQuery = Post::select(['posts.*'])->whereNotNull('posts.type');

        if (request()->has('cat_id')) {
            $latestpostQuery->where('category_id', $request->cat_id);
        }
        $latest_posts = $latestpostQuery->get();

        $products = Product::get();
        $ads = Ad::where('status', 'active')->paginate(3);
        $categories = getBlogCategory();

        return view('frontend.posts', compact('posts', 'page' ,'latest_posts' ,'products', 'ads', 'categories'));
    }

    public function savePoints(Request $request){

        $is_read = UserReaderPost::where('user_id', \Auth::user()->id)->where('post_id', $request->id)->first();
        if($is_read){
            return 0;
        }


       $post = Post::findOrFail($request->id);

       $point = new ClubPoint();
       $point->user_id = \Auth::user()->id;
       $point->point_type = 'Blog Reading';
       $point->points = $request->points;
       $point->order_id = $post->title ?? 'b'.$request->id;
       $point->convert_status = 0;
       $point->created_at = date('Y-m-d h:i:s');
       $point->updated_at = date('Y-m-d h:i:s');
       $point->save();

       $reader = new UserReaderPost();
       $reader->user_id = \Auth::user()->id;
       $reader->post_id = $request->id;
       $reader->created_at = date('Y-m-d h:i:s');
       $reader->updated_at = date('Y-m-d h:i:s');
       $reader->save();

       return 1;
    }
}
