<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stores = Store::get();
        return view('backend.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.stores.create');
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

        $store = new Store();
        $store->name = $request->name;
        $store->cashback = $request->cashback;
        $store->url = $request->url;
        $store->description = $request->description;
        $store->logo = $request->photo;
        $store->created_by = \Auth::user()->id;
        $store->created_at = date('Y-m-d h:i:s');
        $store->updated_at = date('Y-m-d h:i:s');
        $store->save();

        return redirect()->route('stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $store = Store::findOrFail($id);
       return view('frontend.show-store', compact('store'));
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
        $store = Store::findOrFail($id);
        return view('backend.stores.edit', compact('store'));
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

        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->cashback = $request->cashback;
        $store->url = $request->url;
        $store->description = $request->description;
        $store->logo = $request->photos;
        $store->created_by = \Auth::user()->id;
        $store->updated_at = date('Y-m-d h:i:s');
        $store->save(); 

        return redirect()->route('stores.index');
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
    }

    public function bulk_store_delete(Request $request){

        if ($request->ids) {
            foreach ($request->ids as $store_id) {
                Store::findOrFail($store_id)->delete();
            }
        }

        return 1;
    }


    public function allStores(){
        $stores = Store::get();
        return view('frontend.stores', compact('stores'));
    }
}
