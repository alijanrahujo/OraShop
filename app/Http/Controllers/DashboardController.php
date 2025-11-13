<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Load;
use App\Models\Account;
use App\Models\Accessory;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        $date = Session::get('date', function () {
            $today = Carbon::today()->format('Y-m-d');
            Session::put('date', $today);
            return $today;
        });

        $tran_account = Transaction::selectRaw('transactionable_id, SUM(amount) as total')
        ->where('transactionable_type', 'App\\Models\\Account')
        ->where('transaction_date',$date)
        ->groupBy('transactionable_id')
        ->get()
        ->map(function ($item) {
            $account = \App\Models\Account::find($item->transactionable_id);
            return [
                'account_title' => $account ? $account->title.' ('.$account->bank_name.')' : 'Unknown Account',
                'total_amount' => $item->total,
            ];
        });

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
            'loads' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Load'])->sum('previous'),
            'accessories' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Accessory'])->sum('previous'),
            'account' => Transaction::where(['transaction_date'=>$date,'transactionable_type'=>'App\Models\Account'])->sum('previous'),
            'opening_balance' => $currentBalance,
        ];
        $data['closing_balance'] = $data['accessories']+$data['loads']+$data['account'];

        return view('admin.dashboard', compact('tran_account','data','currentBalance','date','accountAll','accounts','transactions', 'loads', 'accessories'));
    }

    public function dashboard2()
    {
        $purchase = Purchase::where('date', Carbon::today())->sum('total_cost');
        $sale = Sale::where('date', Carbon::today())->sum('total_cost');
        $stock = Accessory::sum('quantity');
        $solid = SaleDetail::sum('qty');

        return view('admin.dashboard', compact('purchase', 'sale', 'stock', 'solid'));
    }
}
