<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\profile;
use App\Models\User;
use App\Models\Logs;

class logsInfoController extends Controller
{
    public function index($userid, $schoolid, $logsid, $hostid)
    {
       
        $userProfile = User::find($userid);
        $schoolProfile = Profile::find($schoolid);
        $logsProfile = Logs::find($logsid);
        $hostProfile = Profile::find($hostid);
    
        return view('logsInfo', compact('userProfile', 'schoolProfile', 'logsProfile', 'hostProfile'));
        
    }
}
