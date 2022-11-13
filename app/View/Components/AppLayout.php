<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('layouts.app', ['notifications' => $notifications]);
    }
}
