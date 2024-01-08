<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\profile;
use App\Models\User;
use App\Models\faq;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request)
    {

        $admins = profile::find('1');
        $number_student = User::where('usertype', 'Student')->count();
        $number_spersonnel = User::where('usertype', 'School Personnel')->count();
        $faq = faq::all();

        return view('dashboard',[
            'admins' => $admins,
            'student' => $number_student,
            'faq'=> $faq,
            'spersonnel' => $number_spersonnel
        ]);
    }
    public function schoolProfileUpdate(Request $request){

        $admins = profile::where('id','1')->first();

        $admins->schoolName = $request->schoolName;
        $admins->address =$request->address;

        error_log($admins);
        $admins->save();
        
        return redirect('/dashboard');
    }
    public function schoolMission(Request $request){

        $admins = profile::where('id','1')->first();

        $admins->mission = $request->mission;

        error_log($admins);
        $admins->save();
        
        return redirect('/dashboard');
    }
    public function schoolVision(Request $request){

        $admins = profile::where('id','1')->first();

        $admins->vision = $request->vision;

        error_log($admins);
        $admins->save();
        
        return redirect('/dashboard');
    }
    public function schoolAbout(Request $request){

        $admins = profile::where('id','1')->first();

        $admins->about = $request->about;

        error_log($admins);
        $admins->save();
        
        return redirect('/dashboard');
    }
    public function addFAQ(){
        $faq = new faq();

        $faq->question = request('question'); 
        $faq->answer = request('answer');
        
       error_log($faq);
       $faq->save();
       return redirect('/dashboard');
    }
}
