<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetail extends Model
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
        'sale_id',
        'shop_id',
        'is_closed',
    ];

    public function accessory()
    {
        return $this->hasOne(Accessory::class,'id','accessory_id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class,'id','sale_id');
    }

    public function CloseSale()
    {
        return $this->hasOne(CloseSale::class,'sale_detail_id','id');
    }
}
