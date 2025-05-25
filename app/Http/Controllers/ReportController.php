<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use App\Models\SaleDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;

class ReportController extends Controller
{
    public function saleReport(Request $request)
    {
        $saleDetails = SaleDetail::query();

        if ($request->has('date')) {
            $saleDetails->whereHas('sale', function ($query) use ($request) {
                $query->where('date', $request->date);
            });
        }
        else
        {
            $saleDetails->whereHas('sale', function ($query) use ($request) {
                $query->where('date', Carbon::today());
            });
        }
        $saleDetails = $saleDetails->with('sale')->get();

        return view('admin.reports.sale',compact('saleDetails','request'));
    }

    public function accountReport(Request $request)
    {
        $data = Transaction::where('transactionable_type','App\Models\Account');
        if ($request->has('date')) {
            $data->where('transaction_date', $request->date);
        }
        else
        {
            $data->where('transaction_date', Carbon::today());
        }
        $data = $data->with('transactionable')->get();

        return view('admin.reports.account',compact('data','request'));
    }

    public function loadReport(Request $request)
    {
        $data = Transaction::where('transactionable_type','App\Models\Load');
        if ($request->has('date')) {
            $data->where('transaction_date', $request->date);
        }
        else
        {
            $data->where('transaction_date', Carbon::today());
        }
        $data = $data->with('transactionable')->get();

        return view('admin.reports.load',compact('data','request'));
    }

    public function purchaseReport(Request $request)
    {
        $purchaseDetails = PurchaseDetail::query();

        if ($request->has('date')) {
            $purchaseDetails->whereHas('purchase', function ($query) use ($request) {
                $query->where('date', $request->date);
            });
        }
        else
        {
            $purchaseDetails->whereHas('purchase', function ($query) use ($request) {
                $query->where('date', Carbon::today());
            });
        }
        $purchaseDetails = $purchaseDetails->with('purchase')->get();

        return view('admin.reports.purchase',compact('purchaseDetails','request'));
    }

    public function balanceReport(Request $request)
    {

    }
}
