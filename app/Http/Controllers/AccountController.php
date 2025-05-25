<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();
        return view('admin.account.index', compact('accounts'));
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
            'bank_name' => 'required|string|max:255',
        ]);

        Account::create([
            'title' => $request->title,
            'bank_name' => $request->bank_name,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('account.index')->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('account.index')->with('success', 'Account deleted successfully.');
    }

    public function deposit(Request $request)
    {
        // return $request;
        $request->validate([
            'account_id' => 'required',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $account = Account::find($request->account_id);
        if($account)
        {
            $account->transactions()->create([
                'user_id' => auth()->id(),
                'type' => 'deposit',
                'transaction_date' => $request->date,
                'amount' => $request->amount,
                'previous' => $account->balance,
                'description' => $request->description,
            ]);

            $account->balance += $request->amount;
            $account->save();
        }
        return redirect()->back()->with('success', 'Deposit made successfully.');
    }
}
