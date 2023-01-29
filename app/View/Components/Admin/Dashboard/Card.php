<?php

namespace App\View\Components\Admin\Dashboard;

use Illuminate\View\Component;

class Card extends Component
{
    public $icon;
    public $iconColor;
    public $iconBg;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $iconColor, $iconBg)
    {
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->iconBg = $iconBg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.dashboard.card');
    }
}