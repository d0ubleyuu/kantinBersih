<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Admin extends Component
{
    public $pageTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    public function isDashboard()
    {
        return request()->routeIs('admin.index');
    }

    public function isEmployee()
    {
        return request()->routeIs('admin.employee-page');
    }

    public function isIngredient()
    {
        return request()->routeIs('admin.ingredient-page') || request()->routeIs('admin.restock-page');
    }

    public function isMenu()
    {
        return request()->routeIs('admin.menu-page') || request()->routeIs('admin.edit-menu');
    }

    public function isKasir()
    {
        return request()->routeIs('admin.kasir-page');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.admin');
    }
}