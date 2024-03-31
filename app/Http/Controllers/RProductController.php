<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\RProduct;
use Illuminate\Http\Request;

class RProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = RProduct::get();
        $brands = Brand::pluck('name', 'id')->toArray();
        return view('backend.r_products.index', compact('products', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::pluck('name', 'id')->toArray();
        return view('backend.r_products.create', compact('brands'));
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
        $product = new RProduct();
        $product->title = $request->title;
        $product->brandId = $request->brandId;
        $product->url = $request->url;
        $product->points = $request->points;
        $product->description = $request->description;
        $product->img = $request->photos;
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully.');
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
    public function edit(RProduct $r_product)
    {
        //
        $brands = Brand::pluck('name', 'id')->toArray();
        return view('backend.r_products.edit', compact('brands', 'r_product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RProduct $r_product)
    {
        //
        $r_product->title = $request->title;
        $r_product->brandId = $request->brandId;
        $r_product->url = $request->url;
        $r_product->points = $request->points;
        $r_product->description = $request->description;
        $r_product->img = $request->photos;
        $r_product->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RProduct $r_product)
    {
        //
        $r_product->delete();
        
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
