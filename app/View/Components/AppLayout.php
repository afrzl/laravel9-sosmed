<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Notification;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if (Auth()->check()) {
            $notifications = auth()->user()->unreadNotifications;

            return view('layouts.app', [
                'notifications' => $notifications,
                'logged_in' => true,
                // 'users_notif' => Post::with('user')
                //     ->withCount('comments')
                //     ->latest('id')
                //     ->get(),
            ]);
        } else {
            return view('layouts.app', [
                'logged_in' => false,
            ]);
        }
    }
}
