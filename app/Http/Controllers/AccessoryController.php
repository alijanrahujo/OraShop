<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Category;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessories = Accessory::get();
        $categories = Category::get();
        return view('admin.accessory.index',compact('accessories','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'purchase_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        Accessory::create([
            'title' => $request->title,
            'code' => getNextAccessoryCode(),
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->purchase_price,
            'image' => $request->image ? $request->image->store('images','public') : null,
        ]);

        return redirect()->route('accessory.index')->with('success', 'Accessory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory $accessory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessory $accessory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessory $accessory)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'purchase_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $accessory->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->purchase_price,
            'image' => $request->image ? $request->image->store('images','public') : $accessory->image,
        ]);
        return redirect()->route('accessory.index')->with('success', 'Accessory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessory $accessory)
    {
        $accessory->delete();
        return redirect()->route('accessory.index')->with('success', 'Accessory deleted successfully.');
    }

    public function sale()
    {
        $accessories = Accessory::get();
        return view('admin.accessory.sale', compact('accessories'));
    }
}
