<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Navbar extends Component
{
    public $role;

    /**
     * Create a new component instance.
     */
    public function __construct($role)
    {
        $this->role->nome = $role->nome;
        $this->role->resources = $role->resources;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
