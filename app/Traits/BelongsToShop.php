<?php

namespace App\Traits;

use App\Scopes\ShopScope;

trait BelongsToShop
{
    protected static function bootBelongsToShop()
    {
        static::addGlobalScope(new ShopScope);

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->shop_id = auth()->user()->shop_id;
            }
        });
    }
}
