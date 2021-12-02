<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;

class Wallet extends Component
{
    public $wallets;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($wallets)
    {
        $this->wallets = $wallets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widgets.wallet');
    }
}
