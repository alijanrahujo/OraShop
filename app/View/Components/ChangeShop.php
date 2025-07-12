<?php

namespace App\View\Components;

use App\Models\Shop;
use Illuminate\View\Component;

class ChangeShop extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $shops;
    public $currentShop;

    public function __construct()
    {
        $this->shops = Shop::get();
        $this->currentShop = auth()->user()->shop_id ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.change-shop');
    }
}
