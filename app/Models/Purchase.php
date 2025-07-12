<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'reference_no',
        'user_id',
        'supplier',
        'items',
        'qty',
        'total_discount',
        'total_tax',
        'total_cost',
        'shipping_cost',
        'grand_total',
        'paid_amount',
        'remaining_amount',
        'status',
        'payment_status',
        'date'
    ];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
