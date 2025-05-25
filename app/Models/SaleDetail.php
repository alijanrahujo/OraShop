<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'accessory_id',
        'qty',
        'unit_cost',
        'discount',
        'tax',
        'total',
        'sale_id',
    ];

    public function accessory()
    {
        return $this->hasOne(Accessory::class,'id','accessory_id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class,'id','sale_id');
    }
}
