<?php

namespace App\Http\Controllers;

use App\Models\RPost;
use App\Models\RPostReport;
use App\Models\User;
use Illuminate\Http\Request;

class RPostReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(isset($_GET['status']) && $_GET['status'] == 'completed'){
            $reports = RPostReport::where('status', 'completed')->get();
        }else{
            $reports = RPostReport::where('status', 'pending')->get();
        }
       
        $posts = RPost::pluck('title', 'id')->toArray();
        $users = User::pluck('name','id')->toArray();


        return view('backend.r_reports.index', compact('reports', 'posts', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $new = new RPostReport();
        $new->type = $request->type;
        $new->postId= $request->postId;
        $new->created_by = \Auth::user()->id;
        $new->description = $request->description;
        $new->created_at = date('Y-m-d h:i:s');
        $new->updated_at = date('Y-m-d h:i:s');
        $new->save();

        return redirect()->back()->with('success', 'Your report created successfuly.');
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
        $action = $request->action;
        $report = RPostReport::findOrFail($id);
        $post = RPost::where('id', $report->postId)->first();

        if($action == 'banUser'){
            User::where('id', $post->user_id)->update(['isCreatePost' => 0]);
        }else if($action == 'deletePost'){
            $post->delete();
        }

        $report->status = 'completed';
        $report->save();
        
        return redirect()->back()->with('success', 'Your report updated successfully.');
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
        $report = RPostReport::findOrFail($id);
        $report->delete();
        return 1;
    }
}
