<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    use BelongsToShop;

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
