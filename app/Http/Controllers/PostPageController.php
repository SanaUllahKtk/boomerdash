<?php

namespace App\Http\Controllers;

use App\Models\PostPage;
use Illuminate\Http\Request;

class PostPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = PostPage::get();
        return view('backend.post_page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.post_page.create');
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

        $new = new PostPage();
        $new->heading1 = $request->heading;
        $new->sub_heading = $request->sub_heading;
        $new->banner = $request->photos;
        $new->save();

        return redirect()->route('postpages.index')->with('success', 'Page information saved successfully.');;
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
        $page = PostPage::findOrFail($id);
        return view('backend.post_page.edit', compact('page'));
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
        $new = PostPage::findOrFail($id);
        $new->heading1 = $request->heading;
        $new->sub_heading = $request->sub_heading;
        $new->banner = $request->photos;
        $new->save();

        return redirect()->route('postpages.index')->with('success', 'Page information updated successfully.');;
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
        PostPage::findOrFail($id)->delete();
        return redirect()->route('postpages.index')->with('success', 'Page information deleted successfully.');
    }
}
