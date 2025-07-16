<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessory extends Model
{
    use HasFactory;
    use BelongsToShop;
    protected $softDelete = true;
    protected $fillable = [
        'title',
        'code',
        'description',
        'purchase_price',
        'selling_price',
        'quantity',
        'image',
        'status',
        'category_id',
        'shop_id',
    ];

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function closeAccounts()
    {
        return $this->morphMany(CloseAccount::class, 'closeable');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
