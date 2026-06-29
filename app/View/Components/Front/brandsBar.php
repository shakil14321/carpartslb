<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\brand;

class brandsBar extends Component
{
    /**
     * Create a new component instance.
     */

    public $brands;

    public function __construct($brands = null)
    {
        $this->brands = $brands ?? brand::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.brands-bar');
    }
}
