<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class StoreHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();
        $userinfo = $event->user;
        $saveHistory = DB::table('logs')->insert(
            [
            'user'       => $userinfo->name, 
            'message'    => $event->message, 
            'date'       => $current_timestamp, 
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
            ]
        );
        return $saveHistory;
    }
}
