<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $icon, $title, $link, $isActive, $color;
    /**
     * Create a new component instance.
     */
    public function __construct($icon, $title, $link, $isActive = false, $color = 'text-blue-500')
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->link = $link;
        $this->isActive = $isActive;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item');
    }
}
