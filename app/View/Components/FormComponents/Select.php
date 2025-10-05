<?php

namespace App\View\Components\FormComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    /**
     * Create a new component instance.
     */
    public function __construct($options = [])
    {
        $this->options = $options;
    }
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-components.select', [
            'options' => $this->getOptions()
        ]);
    }
}
