<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PoliticianCard extends Component
{
    public $politician;
    public $checked;
    /**
     * Create a new component instance.
     */
    public function __construct($politician, $checked = false)
    {
        $this->politician = $politician;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.politician-card');
    }
}
