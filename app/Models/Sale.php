<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'items',
        'qty',
        'total_discount',
        'total_tax',
        'total_cost',
        'shipping_cost',
        'grand_total',
        'paid_amount',
        'remaining_amount',
        'payment_status',
        'date',
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
