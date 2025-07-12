<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    use BelongsToShop;
    protected $softDelete = true;

    protected $fillable = [
        'user_id',
        'title',
        'account_number',
        'bank_name',
        'branch_name',
        'account_type',
        'account_holder_name',
        'balance',
        'status',
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
