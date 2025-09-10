<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $edit, $show;
    /**
     * Create a new component instance.
     */
    public function __construct($edit = '#', $show = '#')
    {
        $this->edit = $edit;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
