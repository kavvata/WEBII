<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class TextBox extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $disabled;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $type, $value, $disabled)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-box');
    }
}
