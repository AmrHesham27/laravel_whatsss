<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;

class superAdminNavbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
        $this->active = $active;
    }

    public $active;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.super-admin-navbar');
    }
}
