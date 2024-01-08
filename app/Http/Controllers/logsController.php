<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class logsController extends Controller
{
    public function index()
    {
        $results = DB::select('CALL storedProcLogs()');
        return view('logs', 
        [
            'results' => $results
        ]);
    }
}
