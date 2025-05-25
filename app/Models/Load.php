<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;
    protected $softDelete = true;
    protected $fillable = [
        'title',
        'description',
        'account_number',
        'balance',
        'commission',
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
