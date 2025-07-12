<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Load extends Model
{
    use HasFactory;
    use BelongsToShop;
    protected $softDelete = true;
    protected $fillable = [
        'title',
        'description',
        'account_number',
        'balance',
        'commission',
        'status',
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
}
