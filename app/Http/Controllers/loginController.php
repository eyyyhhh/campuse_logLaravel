<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class loginController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function log( )
    {
        $user = request('user'); 
        $password = request('password');

        try {
            $condition = User::where('username', $user)
                ->where('password', $password)
                ->where('status', 1)
                ->where('usertype', 'Security Guard')
                ->firstOrFail();
                return redirect('/sgDashboard');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            if ($user == 'admin' && $password == 'admin') {
                return redirect('/dashboard');
            } else {
                return redirect('/');
            }
        }
    }
}
