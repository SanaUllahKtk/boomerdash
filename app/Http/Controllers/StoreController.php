<?php

namespace App\Http\Controllers;

use App\Models\StoreFavorite;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\StoreCategory;

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
        $categories = StoreCategory::pluck('name', 'id')->toArray();

        return view('backend.stores.index', compact('stores', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = StoreCategory::pluck('name', 'id')->toArray();
        //
        return view('backend.stores.create', compact('categories'));
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

        $store = new Store();
        $store->name = $request->name;
        $store->cashback = $request->cashback;
        $store->url = $request->url;
        $store->description = $request->description;
        $store->logo = $request->photos;
        $store->created_by = \Auth::user()->id;
        $store->store_category_id = $request->category_id;
        $store->type = $request->type;
        $store->created_at = date('Y-m-d h:i:s');
        $store->updated_at = date('Y-m-d h:i:s');
        $store->save();

        return redirect()->route('stores.index')->with('success', 'Store added successfully.');
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
        $categories = StoreCategory::pluck('name', 'id')->toArray();
        return view('backend.stores.edit', compact('store', 'categories'));
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
        $store->store_category_id = $request->category_id;
        $store->type = $request->type;
        $store->updated_at = date('Y-m-d h:i:s');
        $store->save();

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
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
        Store::findOrFail($id)->delete();
        return 1;
    }

    public function bulk_store_delete(Request $request)
    {

        if ($request->ids) {
            foreach ($request->ids as $store_id) {
                Store::findOrFail($store_id)->delete();
            }
        }

        return 1;
    }


    public function allStores(Request $request)
    {
        $popular_stores_query = Store::query();
        $new_stores_query = Store::query();

        // Check if category_id is provided in the request
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $popular_stores_query->where('store_category_id', $category_id);
            $new_stores_query->where('store_category_id', $category_id);
        }

        // Get filtered popular stores and new stores
        $popular_stores = $popular_stores_query->whereIn('stores.type', ['popular', 'both'])->get();
        $new_stores = $new_stores_query->whereIn('stores.type', ['new', 'both'])->get();


        $categories = StoreCategory::pluck('name', 'id')->toArray();

        $favorites = StoreFavorite::where('user_id', \Auth::user()->id)->pluck('store_id', 'id')->toArray();

        // echo "<pre>";
        // print_r($favorites);
        // die();
        return view('frontend.stores', compact('popular_stores', 'new_stores', 'categories', 'favorites'));
    }

    public function allSellerStores(Request $request){
        $popular_stores_query = Store::query();
        $new_stores_query = Store::query();

        // Check if category_id is provided in the request
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $popular_stores_query->where('store_category_id', $category_id);
            $new_stores_query->where('store_category_id', $category_id);
        }

        // Get filtered popular stores and new stores
        $popular_stores = $popular_stores_query->whereIn('stores.type', ['popular', 'both'])->get();
        $new_stores = $new_stores_query->whereIn('stores.type', ['new', 'both'])->get();


        $categories = StoreCategory::pluck('name', 'id')->toArray();

        $favorites = StoreFavorite::where('user_id', \Auth::user()->id)->pluck('store_id', 'id')->toArray();

        // echo "<pre>";
        // print_r($favorites);
        // die();
        return view('frontend.stores.index', compact('popular_stores', 'new_stores', 'categories', 'favorites'));
    }

    public function favorite(Request $request)
    {
        $store_id = $request->store_id;
        $is_fav = $request->is_fav;

        if ($is_fav == 'saved') {
            $fav = new StoreFavorite();
            $fav->store_id = $store_id;
            $fav->user_id = \Auth::user()->id;
            $fav->type = $request->type;
            $fav->created_at = date('Y-m-d h:i:s');
            $fav->updated_at = date('Y-m-d h:i:s');
            $fav->save();
        } else {
            StoreFavorite::where(['store_id' => $store_id, 'type' => $request->type, 'user_id' => \Auth::user()->id])->delete();
        }
    }


    public function userFavorite()
    {
        $popular_stores = Store::select('stores.*')->join('store_favorites', 'stores.id', '=', 'store_favorites.store_id')->where(['user_id' => \Auth::user()->id])->whereIn('stores.type', ['popular', 'both'])->get();
        $new_stores = Store::join('store_favorites', 'stores.id', '=', 'store_favorites.store_id')->where(['user_id' => \Auth::user()->id])->whereIn('stores.type', ['new', 'both'])->get();
        $categories = StoreCategory::pluck('name', 'id')->toArray();
        $favorites = StoreFavorite::where('user_id', \Auth::user()->id)->pluck('store_id', 'id')->toArray();
        return view('frontend.favorites.index', compact('popular_stores', 'new_stores', 'categories', 'favorites'));
    }
}
