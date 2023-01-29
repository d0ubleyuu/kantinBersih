<?php

namespace App\View\Components\Navigation;

use Illuminate\View\Component;

class Item extends Component
{
    public $active;

    public $href;

    public $icon;

    public $hasChild;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active, $href, $icon, $hasChild)
    {
        $this->active = $active;
        $this->href = $href;
        $this->icon = $icon;
        $this->hasChild = $hasChild;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navigation.item');
    }
}