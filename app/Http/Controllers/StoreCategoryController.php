<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = StoreCategory::get();
        return view('backend.storecategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.storecategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
        ];
        
        // Custom error messages
        $messages = [
            'name.required' => 'The store category name is required.',
        ];
        
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        
        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }  
        
        $category = new StoreCategory();
        $category->name = $request->name;
        $category->created_by = \Auth::user()->id;
        $category->created_at = date('Y-m-d h:i:s');
        $category->updated_at = date('Y-m-d h:i:s');
        $category->save();

        return redirect()->route('store-categories.index')->with('success', 'Category added successfully.');
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
        $category = StoreCategory::findOrFail($id);
        return view('backend.storecategory.edit', compact('category'));
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
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
        ];
        
        // Custom error messages
        $messages = [
            'name.required' => 'The store category name is required.',
        ];
        
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
        
        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }  
        
        StoreCategory::where('id', $id)->update(['name' => $request->name]);
        return redirect()->route('store-categories.index')->with('success', 'Category updated successfully.');
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
        StoreCategory::findOrFail($id)->delete();
        return 1;
    }

    public function bulk_category_delete(Request $request){
        if ($request->ids) {
            foreach ($request->ids as $store_id) {
                StoreCategory::findOrFail($store_id)->delete();
            }
        }

        return 1;
    }
}
