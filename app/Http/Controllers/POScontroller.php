<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\Accessory;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class POScontroller extends Controller
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
        return view('admin.pos.index',compact('accessories','categories'));
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

            return redirect()->route('pos.index')->with('success', 'Sale out successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create sale: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
