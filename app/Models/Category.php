<?php

namespace App\Models;

use App\Traits\BelongsToShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use BelongsToShop;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function Accessories()
    {
        return $this->hasMany(Accessory::class,'category_id','id');
    }
}
