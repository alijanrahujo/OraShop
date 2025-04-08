<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $softDelete = true;
    protected $fillable = [
        'title',
        'description',
        'purchase_price',
        'selling_price',
        'quantity',
        'image',
        'status',
    ];

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
