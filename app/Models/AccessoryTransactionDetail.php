<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryTransactionDetail extends Model
{
    use HasFactory;
    use BelongsToShop;
}
