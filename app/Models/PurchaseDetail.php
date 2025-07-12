<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetail extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'accessory_id',
        'qty',
        'unit_cost',
        'discount',
        'tax',
        'total',
        'purchase_id'
    ];

    public function accessory()
    {
        return $this->hasOne(Accessory::class,'id','accessory_id');
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class,'id','purchase_id');
    }
}
