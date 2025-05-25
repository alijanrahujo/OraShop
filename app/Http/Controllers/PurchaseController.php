<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accessories = Accessory::get();
        return view('admin.purchase.create',compact('accessories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier'       => 'nullable|string|max:255',
            'reference_no'   => 'nullable|string|max:255',
            'accessory_id'   => 'required|array',
            'accessory_id.*' => 'required|exists:accessories,id',
            'qty'            => 'required|array',
            'qty.*'          => 'required|integer|min:1',
            'price'          => 'required|array',
            'price.*'        => 'required|numeric|min:0',
            'date'           => 'required|date',
            'status'         => 'nullable|in:0,1,2,3,4',
        ]);

        DB::beginTransaction();

        try {
            $quantities = array_map('intval', $request['qty']);
            $prices     = array_map('floatval', $request['price']);

            $totalQty   = array_sum($quantities);
            $totalPrice = array_sum(array_map(fn($q, $p) => $q * $p, $quantities, $prices));

            $purchase = Purchase::create([
                'supplier'        => $request['supplier'],
                'reference_no'    => $request['reference_no'],
                'items'           => count($request['accessory_id']),
                'qty'             => $totalQty,
                'total_discount'  => 0,
                'total_tax'       => 0,
                'total_cost'      => $totalPrice,
                'shipping_cost'   => 0,
                'grand_total'     => $totalPrice,
                'paid_amount'     => $totalPrice,
                'remaining_amount'=> 0,
                'status'          => $request['status'] ?? 1,
                'payment_status'  => 2,
                'date'            => $request['date'],
                'user_id'         => Auth::id(),
            ]);

            foreach ($request['accessory_id'] as $index => $id) {
                $qty   = $quantities[$index];
                $price = $prices[$index];
                $total = $qty * $price;

                PurchaseDetail::create([
                    'purchase_id'  => $purchase->id,
                    'accessory_id' => $id,
                    'qty'          => $qty,
                    'unit_cost'    => $price,
                    'discount'     => 0,
                    'tax'          => 0,
                    'total'        => $total,
                ]);

                $accessory = Accessory::find($id);

                if ($accessory) {

                    $accessory->transactions()->create([
                        'user_id' => auth()->id(),
                        'type' => 'purchase',
                        'transaction_date' => $request->date,
                        'amount' => $price,
                        'previous' => $accessory->quantity,
                        'description' => 'Accessory Purchase',
                    ]);

                    $updates = [];
                    $updates['quantity'] = $accessory->quantity+$qty;

                    if ($price != $accessory->purchase_price) {
                        $updates['purchase_price'] = $price;
                    }

                    if ($accessory->selling_price <= $price) {
                        $updates['selling_price'] = round($price * 1.10, 2); // 10% markup
                    }

                    if ($updates) {
                        $accessory->update($updates);
                    }
                }
            }

            DB::commit();

            return redirect()->route('purchase.index')->with('success', 'Purchase created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create purchase: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
