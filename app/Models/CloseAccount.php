<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CloseAccount extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'title',
        'previous',
        'current',
        'debit',
        'credit',
        'balance',
        'commission',
        'date',
        'closeable_type',
        'closeable_id',
        'user_id',
        'shop_id',
    ];

    public function closeable()
    {
        return $this->morphTo();
    }

}
