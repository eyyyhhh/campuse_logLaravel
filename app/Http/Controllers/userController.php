<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function index(Request $request)
    {

        $number_student = User::where('usertype', 'Student')->count();
        $number_spersonnel = User::where('usertype', 'School Personnel')->count();
        $posts = User::where('status', 1)->where('school_id', 1)->paginate(20);

        return view('users',[
            'student' => $number_student,
            'spersonnel' => $number_spersonnel,
            'posts' => $posts
        ]);
    }
    public function addUser(){
        $user = new User();

        $user->usernum = request('usernum');
        $user->username = request('username'); 
        $user->password = request('password'); 
        $user->phone = request('phone');
        $user->usertype = request('usertype'); 
        $user->gender = request('gender');
        $user->address = request('address'); 
        $user->school_id = 1;
        $user->status = 1; 
        $user->age = request('age');
        $user->birthdate = request('birthdate'); 
        
       error_log($user);
       $user->save();
       return redirect()->route('users');
    }
    public function softDelete($id)
    {
        $item = User::findOrFail($id);
        $item->status = 0;
        $item->save();

        return redirect()->route('users');
    }

}
