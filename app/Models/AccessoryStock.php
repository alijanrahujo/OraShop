<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryStock extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'accessory_id',
        'shop_id',
        'quantity',
    ];
}
