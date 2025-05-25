<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

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
