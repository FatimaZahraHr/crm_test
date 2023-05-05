<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    //get logs
    public function getlogs()
    {
        $logs = Log::paginate(10);
        return response($logs, 200);
    }
}
