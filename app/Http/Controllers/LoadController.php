<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loads = Load::get();
        return view('admin.load.index',compact('loads'));
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'commission' => 'required|numeric',
        ]);

        Load::create([
            'title' => $request->title,
            'description' => $request->description,
            'commission' => $request->commission,
        ]);

        return redirect()->route('load.index')->with('success', 'Load created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function show(Load $load)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function edit(Load $load)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Load $load)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load)
    {
        $load->delete();
        return redirect()->route('load.index')->with('success', 'Load Account deleted successfully.');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'load_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $load = Load::find($request->load_id);
        if($load)
        {
            $load->transactions()->create([
                'user_id' => auth()->id(),
                'type' => 'deposit',
                'transaction_date' => $request->date,
                'amount' => $request->amount,
                'previous' => $load->balance,
                'description' => 'Load Deposit',
            ]);

            $load->balance += $request->amount;
            $load->save();
        }
        return redirect()->back()->with('success', 'Deposit made successfully.');
    }
}
