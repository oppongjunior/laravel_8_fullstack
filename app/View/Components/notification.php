<?php

namespace App\View\Components;

use App\Models\Notification as myNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\View\Component;

class notification extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {


        return view('components.notification');
    }
}
