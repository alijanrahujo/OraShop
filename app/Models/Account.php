<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
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
}
