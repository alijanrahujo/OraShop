<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'user_id',
        'transactionable_id',
        'transactionable_type',
        'type',
        'amount',
        'previous',
        'description',
        'transaction_date',
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
