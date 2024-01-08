<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\profile;

class SGdashboardController extends Controller
{
    
    public function index()
    {   
        $admins = profile::find('1');
        $results = DB::select('CALL storedProcLogs()');
        return view('Sgdashboard', 
        [ 
            'admins' => $admins,
            'results' => $results
        ]);
    }
}
