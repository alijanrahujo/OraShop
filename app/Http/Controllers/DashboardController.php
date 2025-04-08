<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Models\Account;
use App\Models\Accessory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $accounts = Account::get();
        $accountAll = Account::get();
        $loads = Load::get();
        $accessories = Accessory::get();

        if($request->has('account_id'))
        {
            $accounts = Account::whereIn('id', $request->account_id)->get();
        }
        if($request->has('date'))
        {
            $date = $request->date;
        }

        $deposits = Transaction::where('transaction_date','<',$date)->where('type', 'deposit')->sum('amount');
        $withdrawals = Transaction::where('transaction_date','<',$date)->where('type', 'withdrawal')->sum('amount');
        $currentBalance = $deposits - $withdrawals;

        $transactions = Transaction::where('transaction_date',$date)->get();

        // return $data = [
        //     'loads' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Load'])->selectRaw("SUM(CASE WHEN type = 'deposit' THEN amount ELSE 0 END) - SUM(CASE WHEN type = 'withdrawal' THEN amount ELSE 0 END) as balance")->value('balance'),
        //     'accessories' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Account'])->selectRaw("SUM(CASE WHEN type = 'sale' THEN amount ELSE 0 END) - SUM(CASE WHEN type = 'purchase' THEN amount ELSE 0 END) as balance")->value('balance'),
        //     'account' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Account'])->selectRaw("SUM(CASE WHEN type = 'deposit' THEN amount ELSE 0 END) - SUM(CASE WHEN type = 'withdrawal' THEN amount ELSE 0 END) as balance")->value('balance'),
        //     'opening_balance' => $currentBalance,
        // ];

        $data = [
            'loads' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Load'])->sum('entry_amount'),
            'accessories' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Accessory'])->sum('entry_amount'),
            'account' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Account'])->sum('entry_amount'),
            'opening_balance' => $currentBalance,
        ];
        $data['closing_balance'] = $data['accessories']+$data['loads']+$data['account'];

        return view('admin.dashboard', compact('data','currentBalance','date','accountAll','accounts','transactions', 'loads', 'accessories'));
    }
}
