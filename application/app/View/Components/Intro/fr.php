<?php

namespace App\View\Components\Intro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class fr extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.intro.fr');
    }
}
