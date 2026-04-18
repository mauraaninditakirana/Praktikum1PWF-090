<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateProduct extends Component
{
    public string $url;
    public string $type;
    /**
     * Create a new component instance.
     */
    public function __construct(string $url, string $type = 'edit')
    {
        $this->url = $url;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-product');
    }
}
