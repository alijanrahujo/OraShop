<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'sale_detail_id',
        'code',
        'title',
        'category',
        'purchase_price',
        'qty',
        'unit_cost',
        'total_qty',
        'commission',
        'profit',
    ];

    public function SaleDetail()
    {
        return $this->hasOne(SaleDetail::class,'id','sale_detail_id');
    }
}
