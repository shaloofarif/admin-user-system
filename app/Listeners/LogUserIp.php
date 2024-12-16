<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Ip;
use Illuminate\Auth\Events\Login;


class LogUserIp
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Get the logged-in user and the IP address
        $user = $event->user;
        $ipAddress = request()->ip();

        // Record the login in the IPs table
        Ip::create([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'logged_in_at' => now(), // Set the current time as the login time
        ]);
    }
}
