<?php

namespace App\View\Components\Front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CarBrand;

class brandsBar extends Component
{
    /**
     * Create a new component instance.
     */

    public $carBrands;

    public function __construct($carBrands = null)
    {
        $this->carBrands = $carBrands ?? CarBrand::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.brands-bar');
    }
}
