<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
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
     */
    public function handle(Login $event): void
    {
        \App\Models\LoginHistory::create([
            'user_id' => $event->user->id,
            'ip_address' => \Illuminate\Support\Facades\Request::ip(),
            'user_agent' => \Illuminate\Support\Facades\Request::userAgent(),
            'status' => 'success',
            'device' => \Illuminate\Support\Facades\Request::header('sec-ch-ua-platform'), // Optional client hint
        ]);
    }
}
