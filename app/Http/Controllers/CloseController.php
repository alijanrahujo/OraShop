<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Account;
use Illuminate\Http\Request;

class CloseController extends Controller
{
    public function account(Request $request)
    {
        // return $request;
        $request->validate([
            'account_id' => 'required|array',
            'date' => 'required|date',
        ]);

        foreach($request->account_id as $key=>$account_id)
        {
            $account = Account::find($account_id);
            if($account)
            {
                if($account->balance >= $request['amount'][$key])
                {
                    $amount = $account->balance - $request['amount'][$key];
                    $type = 'withdrawal';
                    $account->balance -= $amount;
                    $account->save();
                }
                else
                {
                    $amount = $request['amount'][$key] - $account->balance;
                    $type = 'deposit';
                    $account->balance += $amount;
                    $account->save();
                }
                $account->transactions()->create([
                    'user_id' => auth()->id(),
                    'type' => $type,
                    'transaction_date' => $request->date,
                    'amount' => $amount,
                    'entry_amount' => $request['amount'][$key],
                    'description' => 'Account closed',
                ]);
            }
        }
        return redirect()->back()->with('success', 'Account closed successfully.');
    }

    public function load(Request $request)
    {
        $request->validate([
            'load_id' => 'required|array',
            'date' => 'required|date',
        ]);

        foreach($request->load_id as $key=>$load_id)
        {
            $load = Load::find($load_id);
            if($load && $request['amount'][$key] > 0)
            {
                if($load->balance >= $request['amount'][$key])
                {
                    $amount = $load->balance - $request['amount'][$key];
                    $type = 'withdrawal';
                    $commission = ($amount / 1000) * $load->commission;
                    $load->balance -= $amount;
                    $load->save();
                }
                else
                {
                    $amount = $request['amount'][$key] - $load->balance;
                    $type = 'deposit';
                    $commission = 0;
                    $load->balance += $amount;
                    $load->save();

                }
                $load->transactions()->create([
                    'user_id' => auth()->id(),
                    'type' => $type,
                    'transaction_date' => $request->date,
                    'amount' => $amount,
                    'entry_amount' => $request['amount'][$key],
                    'description' => 'Load closed',
                ]);

                if($commission >0)
                {
                    $load->transactions()->create([
                        'user_id' => auth()->id(),
                        'type' => 'deposit',
                        'transaction_date' => $request->date,
                        'amount' => $commission,
                        'entry_amount' => $commission,
                        'description' => 'Load commission closed',
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Load closed successfully.');
    }

    public function mobile_wallet(Request $request)
    {
        $request->validate([
            'commission' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $account = Account::where('title','Cash')->first();
        if($account && $request->commission >0)
        {
            $account->transactions()->create([
                'user_id' => auth()->id(),
                'type' => 'deposit',
                'transaction_date' => $request->date,
                'amount' => $request->commission,
                'entry_amount' => $request->commission,
                'description' => 'EasyPaisa/JazzCash commission closed',
            ]);
        }

        return redirect()->back()->with('success', 'EasyPaisa/JazzCash commission closed successfully.');
    }
}
