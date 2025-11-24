<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Account;
use App\Models\CloseSale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class CloseController extends Controller
{

    public function sellClose()
    {
        $date = date('Y-m-d');
        // $date = "2025-11-05";

        // $sales = SaleDetail::whereHas('sale', function($query) use ($date) {
        //     $query->where('date','=',$date);
        // })->with('sale','CloseSale')->get();

        $sales = SaleDetail::where('is_closed',false)->with('sale','CloseSale')->get();

        return view('admin.sale.close', compact('sales','date'));
    }

    public function closestore(Request $request)
    {
        // return $request;
        $request->validate([
            'date' => 'required|date',
            'sale_detail_id' => 'required|array',
            'code' => 'required|array',
            'title' => 'required|array',
            'category' => 'required|array',
            'purchase_price' => 'required|array',
            'qty' => 'required|array',
            'unit_cost' => 'required|array',
            'total_qty' => 'required|array',
            'commission' => 'required|array',
            'profit' => 'required|array',

        ]);

        foreach($request->sale_detail_id as $key=>$sale_detail_id)
        {
            $close_sale = new CloseSale;
            $close_sale->date = $request->date;
            $close_sale->sale_detail_id = $sale_detail_id;
            $close_sale->code = $request->code[$key];
            $close_sale->title = $request->title[$key];
            $close_sale->category = $request->category[$key];
            $close_sale->purchase_price = $request->purchase_price[$key];
            $close_sale->qty = $request->qty[$key];
            $close_sale->unit_cost = $request->unit_cost[$key];
            $close_sale->total_qty = $request->total_qty[$key];
            $close_sale->commission = $request->commission[$key];
            $close_sale->profit = $request->profit[$key];
            $close_sale->save();

            if($close_sale)
            {
                $sale_detail = SaleDetail::find($sale_detail_id);
                if($sale_detail)
                {
                    $sale_detail->is_closed = 1;
                    $sale_detail->save();
                }
            }
        }

        return redirect('/')->with('success', 'Sales closed successfully.');
    }

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
                    'previous' => $request['amount'][$key],
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
                    'previous' => $request['amount'][$key],
                    'description' => 'Load closed',
                ]);

                if($commission >0)
                {
                    $load->transactions()->create([
                        'user_id' => auth()->id(),
                        'type' => 'deposit',
                        'transaction_date' => $request->date,
                        'amount' => $commission,
                        'previous' => $commission,
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
                'previous' => $request->commission,
                'description' => 'EasyPaisa/JazzCash commission closed',
            ]);
        }

        return redirect()->back()->with('success', 'EasyPaisa/JazzCash commission closed successfully.');
    }
}
