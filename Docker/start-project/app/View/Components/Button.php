<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Button extends Component
{
    public $label;
    public $type;
    public $route;
    public $color;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $type, $route, $color)
    {
        $this->label = $label;
        $this->type = $type;
        $this->route = $route;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
