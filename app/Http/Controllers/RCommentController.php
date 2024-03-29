<?php

namespace App\Http\Controllers;

use App\Models\RComment;
use Illuminate\Http\Request;

class RCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Validate the incoming request data
        $request->validate([
            'comment_text' => 'required'
            // Add validation rules for dropzone files if required
        ]);

        $r_comment = new RComment();
        $r_comment->post_id = $request->post_id;
        $r_comment->description = $request->comment_text;
        $r_comment->user_id = \Auth::user()->id;
        $r_comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
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
        $rcomment = RComment::findOrFail($id);
        $rcomment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RComment $r_comment)
    {
        return view('frontend.r_comments.edit');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rcomment = RComment::findOrFail($id);
        $rcomment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
