<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ads = Ad::get();
        return view('backend.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new Ad();
        $new->title = $request->title;
        $new->expire = $request->expire;
        $new->status = $request->status;
        $new->photo = $request->photos;
        
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

        $new->created_at = date('Y-m-d h:i:s');
        $new->updated_at = date('Y-m-d h:i:s');
        $new->save();

        flash(translate('Ad created successfully.'))->success();
        return redirect()->route('ads.index');


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
        $ad = Ad::findOrFail($id);
        return view('backend.ads.edit', compact('ad'));
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
        $new = Ad::findOrFail($id);
        $new->title = $request->title;
        $new->expire = $request->expire;
        $new->status = $request->status;
        $new->photo = $request->photos;
        
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

        $new->created_at = date('Y-m-d h:i:s');
        $new->updated_at = date('Y-m-d h:i:s');
        $new->save();

        flash(translate('Ad updated successfully.'))->success();
        return redirect()->route('ads.index');

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
        Ad::findOrFail($id)->delete();
        flash(translate('Ad deleted successfully.'))->success();
        return redirect()->route('ads.index');
    }

    public function AddClick(Request $request){
        $ad = Ad::findOrFail($request->id);
        $click = $ad->clicks;
        $ad->clicks = ($click + 1);
        $ad->save();   
    }


    public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $request->file('image')->store('ad_images');

    // Modify the image path as needed
    $shortImagePath = 'public/' . $imagePath;

    return asset($shortImagePath);
}


    public function uploadVideo(Request $request)
    {
        // Validate the uploaded video file
        $request->validate([
            'video' => 'required|mimetypes:video/*|max:204800', // Adjust max size as needed
        ]);

        // Store the uploaded video
        $videoPath = $request->file('video')->store('video_files');

        // Return the URL of the uploaded video
        return asset('storage/' . $videoPath);
    }
}
