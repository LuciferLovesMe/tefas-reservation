<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PillStatus extends Component
{
    public string $label;
    public string $colorClass;

    /**
     * Create a new component instance.
     *
     * @param string $status The status value (e.g., 'pending', 'done', 'cancel').
     */
    public function __construct(public string $status)
    {
        // Convert status to lowercase for case-insensitive matching
        $status = strtolower($status);

        switch ($status) {
            case 'pending':
                $this->label = 'Menunggu';
                $this->colorClass = 'bg-warning text-dark';
                break;
            case 'done':
                $this->label = 'Selesai';
                $this->colorClass = 'bg-success';
                break;
            case 'cancel':
                $this->label = 'Dibatalkan';
                $this->colorClass = 'bg-danger';
                break;
            default:
                $this->label = ucfirst($status);
                $this->colorClass = 'bg-secondary';
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pill-status', [
            'label' => $this->label,
            'colorClass' => $this->colorClass,
        ]);
    }
}
