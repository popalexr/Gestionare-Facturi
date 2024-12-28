<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrintLayout extends Component
{

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('layouts.print');
    }
}
