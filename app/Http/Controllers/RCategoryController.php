<?php

namespace App\Http\Controllers;

use App\Models\RCategory;
use Illuminate\Http\Request;

class RCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = RCategory::all();
        return view('backend.r_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.r_categories.create');
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
            'name' => 'required|unique:r_categories|max:255',
            // Add more validation rules as needed
        ], [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already been taken.',
            'name.max' => 'The name may not be greater than :max characters.',
            // Add more custom error messages as needed
        ]);

        // Create a new category using mass assignment
        RCategory::create($request->only('name'));

        // Redirect back to the index page with a success message
        return redirect()->route('r_categories.index')
            ->with('success', 'Category created successfully.');
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
    public function edit(RCategory $r_category)
    {
        return view('backend.r_categories.edit', compact('r_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RCategory $r_category)
    {
        $request->validate([
            'name' => 'required|unique:r_categories|max:255',
            // Add more validation rules as needed
        ]);

        $r_category->update($request->all());

        return redirect()->route('r_categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Logic to delete the category
        $category = RCategory::findOrFail($id);
        $category->delete();

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
