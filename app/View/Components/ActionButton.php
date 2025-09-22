<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $edit, $destroy, $id;
    /**
     * Create a new component instance.
     */
    public function __construct($edit = '#', $destroy = '#', $id = null)
    {
        $this->edit = $edit;
        $this->destroy = $destroy;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button', [
            'edit' => $this->edit,
            'destroy' => $this->destroy,
            'id' => $this->id
        ]);
    }
}
