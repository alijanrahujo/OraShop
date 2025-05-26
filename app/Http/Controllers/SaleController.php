<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Accessory;
use App\Models\SaleDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with('saleDetails.accessory')->get();
        return view('admin.sale.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accessories = Accessory::get();
        return view('admin.sale.create',compact('accessories'));
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
            'accessory_id'   => 'required|array',
            'accessory_id.*' => 'required|exists:accessories,id',
            'qty'            => 'required|array',
            'qty.*'          => 'required|integer|min:1',
            'price'          => 'required|array',
            'price.*'        => 'required|numeric|min:0',
            'date'           => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $quantities = array_map('intval', $request['qty']);
            $prices     = array_map('floatval', $request['price']);

            $totalQty   = array_sum($quantities);
            $totalPrice = array_sum(array_map(fn($q, $p) => $q * $p, $quantities, $prices));

            $sale = Sale::create([
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

                SaleDetail::create([
                    'sale_id'  => $sale->id,
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
                        'type' => 'sale',
                        'transaction_date' => $request->date,
                        'amount' => $total,
                        'previous' => $accessory->quantity,
                        'description' => 'Accessory Sale',
                    ]);

                    $updates = [];

                    $updates['quantity'] = $accessory->quantity-$qty;

                    if ($updates) {
                        $accessory->update($updates);
                    }
                }
            }

            DB::commit();

            return redirect()->route('sale.index')->with('success', 'Sale created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create sale: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $saleDetails = SaleDetail::with('accessory')->where('sale_id', $sale->id)->get();
        return view('admin.sale.show', compact('sale', 'saleDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $accessories = Accessory::get();
        $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
        return view('admin.sale.edit', compact('sale', 'accessories', 'saleDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'accessory_id' => 'required|array',
            'accessory_id.*' => 'required|exists:accessories,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Get existing sale details
            $existingDetails = SaleDetail::where('sale_id', $sale->id)->get();
            
            // Subtract quantities from accessories for existing sale details
            foreach ($existingDetails as $detail) {
                $accessory = Accessory::find($detail->accessory_id);
                if ($accessory) {
                    $accessory->quantity += $detail->qty;
                    $accessory->save();

                    $accessory->transactions()->where('type', 'sale')->where('transaction_date', $sale->date)->delete();
                }
            }

            // Delete existing sale details
            SaleDetail::where('sale_id', $sale->id)->delete();

            // Calculate totals
            $totalQty = 0;
            $totalPrice = 0;

            // Create new sale details and update accessories
            foreach ($request->accessory_id as $key => $accessoryId) {
                $qty = $request->qty[$key];
                $price = $request->price[$key];
                $total = $qty * $price;

                // Create sale detail
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'accessory_id' => $accessoryId,
                    'qty' => $qty,
                    'unit_cost' => $price,
                ]);

                // Update accessory quantity
                $accessory = Accessory::find($accessoryId);
                if ($accessory) {
                    $accessory->quantity -= $qty;
                    $accessory->save();

                    // Create transaction record
                    $accessory->transactions()->create([
                        'user_id' => auth()->id(),
                        'type' => 'sale',
                        'transaction_date' => $request->date,
                        'amount' => $total,
                        'previous' => $accessory->quantity,
                        'description' => 'Accessory Sale',
                    ]);
                }

                $totalQty += $qty;
                $totalPrice += ($qty * $price);
            }

            // Update sale
            $sale->update([
                'total_qty' => $totalQty,
                'total_price' => $totalPrice,
                'date' => $request->date,
            ]);

            DB::commit();
            return redirect()->route('sale.index')->with('success', 'Sale updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating sale: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        DB::beginTransaction();
        try {
            // Get sale details to update accessory quantities
            $saleDetails = SaleDetail::where('sale_id', $sale->id)->get();
            foreach ($saleDetails as $detail) {
                $accessory = Accessory::find($detail->accessory_id);
                if ($accessory) {
                    // Update accessory quantity back
                    $accessory->update(['quantity' => $accessory->quantity + $detail->qty]);
                    // Delete related transactions
                    $accessory->transactions()->where('type', 'sale')->where('transaction_date', $sale->date)->delete();
                }
            }
            // Delete related sale details
            SaleDetail::where('sale_id', $sale->id)->delete();
            // Delete the sale
            $sale->delete();
            DB::commit();
            return redirect()->route('sale.index')->with('success', 'Sale deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete sale: ' . $e->getMessage()]);
        }
    }
}
