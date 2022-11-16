<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CustomDbChannel extends Controller
{
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toDatabase($notifiable);

        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,

            //customize here
            'notified_by' => $data['comment']['user_id'], //<-- comes from toDatabase() Method below
            'notifiable_id' => \Auth::user()->id,

            'type' => get_class($notification),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}
