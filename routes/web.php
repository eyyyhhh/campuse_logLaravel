<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\navigationController;
use App\Http\Controllers\dashboardController;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\Artisan;
use Spatie\Backup\BackupDestination\Backup as SpatieBackup;


Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

//login
Route::get('/', [loginController::class, 'index']);

Route::post('/login', [loginController::class, 'log']);

//dashboard
Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
Route::get('updates/{schoolName}/{address}','dashboardController@schoolProfileUpdate')->name('update.profile');
Route::get('updatesMission/{mission}','dashboardController@schoolMission')->name('update.mission');
Route::get('updatesVision/{vision}','dashboardController@schoolVision')->name('update.vision');
Route::get('updatesAbout/{about}','dashboardController@schoolAbout')->name('update.about');
Route::post('dashboard/faq','dashboardController@addFAQ')->name('add.FAQ');

//logs
Route::get('/logs', 'logsController@index')->name('logs');

//view logs
Route::get('/viewlogs/{userid}/{schoolid}/{logsid}/{hostid}', 'logsInfoController@index')->name('viewlogs');

//user
Route::get('/users', 'userController@index')->name('users');
Route::get('/users/{id}/soft-delete', 'userController@softDelete')->name('userdelete');

Route::post('users/add','userController@addUser')->name('add.User');

//SG Dashboard
Route::get('/sgDashboard', 'sgdashboardController@index')->name('sgdashboard');

//Bulk Upload
Route::get('/upload-form', 'ExcelUploadController@uploadForm');
Route::post('/import', 'ExcelUploadController@import');

//Backup
Route::get('/backup', function () {
    try {
        // Perform backup
        $backupJob = new BackupJob(config('backup'));
        $backupJob->run();

        return redirect()->back()->with('success', 'Backup completed successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
    }
})->name('backup');

// Restore
Route::get('/restore', function () {
    try {
        // Perform restore
        Artisan::call('backup:restore', ['--source' => config('backup.backup.name')]);

        return redirect()->back()->with('success', 'Restore completed successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Restore failed: ' . $e->getMessage());
    }
})->name('restore');