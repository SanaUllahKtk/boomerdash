<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoWatch;
use App\Models\VideoWatchExpo;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CategoryTranslation;
use App\Utility\CategoryUtility;
use Illuminate\Support\Str;
use Cache;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $videos = Video::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $videos = $videos->where('name', 'like', '%'.$sort_search.'%');
        }
        $videos = $videos->paginate(15);
        return view('backend.product.videos.index', compact('videos', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videos = Video::all();

        return view('backend.product.videos.create', compact('videos'));
    }
    public function search(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;
        $video_id = $request->video_id;
        $videos = VideoWatch::where('video_id',$request->video_id)->whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])->get();
        $html = view('backend.product.videos.videowatch', compact('videos','video_id'))->render();
        return response()->json(array('html'=>$html));
    }
    
    public function excelexpo($id,Request $request)
    {
        $from_date=$request->start_date;
        $to_date = $request->end_date;
        return Excel::download(new VideoWatchExpo($from_date,$to_date,$id), 'watchhistory-'.date("h:i:s").'.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Video;
        $category->name = $request->name;    
        if ($request->has('videolink')) {
            $video = $request->file('videolink');
            $video_extenstion = strtolower($video->getClientOriginalExtension());
            $allow_extentions = array('mp4');
            if (!in_array($video_extenstion, $allow_extentions)) {
               return Redirect::back()->withErrors(['msg' => 'Video format is not allowed only MP4 is allowed format']);
            }
            $filename = '_'.time().rand(11111,9999). '.';
            $video_path = $filename.$video_extenstion;
            $video_url = $video->move('public/uploads/video/', $video_path);
        }
        $category->videolink = $video_url;
        $category->point = $request->point;
        $category->banner = $request->banner;
        $category->meta_description = $request->meta_description;
        $category->save();

       

        flash(translate('Video has been inserted successfully'))->success();
        return redirect()->route('videos.index');
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
    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $video = Video::findOrFail($id);

        return view('backend.product.videos.edit', compact('video', 'lang'));
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
        $category = Video::findOrFail($id);
        $category->name = $request->name;    
        if ($request->has('videolink')) {
            $video = $request->file('videolink');
            $video_extenstion = strtolower($video->getClientOriginalExtension());
            $allow_extentions = array('mp4');
            if (!in_array($video_extenstion, $allow_extentions)) {
               return Redirect::back()->withErrors(['msg' => 'Video format is not allowed only MP4 is allowed format']);
            }
            $filename = '_'.time().rand(11111,9999). '.';
            $video_path = $filename.$video_extenstion;
            $video_url = $video->move('public/uploads/video/', $video_path);
        $category->videolink = $video_url;
        }
        $category->point = $request->point;
        $category->banner = $request->banner;
        $category->meta_description = $request->meta_description;
        $category->save();
        flash(translate('Video has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Video::findOrFail($id);
       $categorydel = Video::where('id',$category->id)->delete();

     
    
        flash(translate('Video has been deleted successfully'))->success();
        return back();
    }

    public function updateFeatured(Request $request)
    {
        $category = Video::findOrFail($request->id);
        $category->featured = $request->status;
        $category->save();
    }
}
