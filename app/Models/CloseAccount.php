<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseAccount extends Model
{
    use HasFactory;

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
    ];

    public function closeable()
    {
        return $this->morphTo();
    }

}
