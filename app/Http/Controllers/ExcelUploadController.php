<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\userImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\profile;
use App\Models\User;

class ExcelUploadController extends Controller
{
    public function uploadForm()
    {
        return view('users');
    }

   
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:10240', // Adjust allowed file types and size
        ]);

        $file = $request->file('file');

        Excel::import(new userImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
