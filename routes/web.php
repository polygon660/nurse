<?php

use App\Models\history;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/test','test')->name('test');


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});
// Route::view('/','auth.login')->name('login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route::view('/dashboard', 'pages.dashboard.dashboard')->name('dashboard');
    Route::prefix('workspace')->name('workspace.')->group(function () {
        $workspace = "pages.workspace.";
        Route::view('/index', $workspace . 'workspace')->name('workspaces');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        $setting = "pages.setting.";
        Route::view('/role', $setting . 'role')->name('roles');
        Route::view('/drug', $setting . 'drug')->name('drugs');
        Route::view('/medic', $setting . 'medic')->name('medics');
        Route::view('/type', $setting . 'type')->name('type');
        Route::view('/prefix', $setting . 'prefix')->name('prefix');
        Route::view('/gender', $setting . 'gender')->name('gender');
    });

    // /workspace/index

    Route::prefix('workspace')->name('workspace.')->group(function () {
        $workspace = "pages.workspace.";
        Route::view('/index', $workspace . 'workspace')->name('workspaces');
    });
    Route::prefix('registryguest')->name('registryguest.')->group(function () {
        $registryguest = "pages.registryguest.";
        Route::view('/index', $registryguest . 'registryguest')->name('registryguests');
    });
    Route::prefix('historyboard')->name('historyboard.')->group(function () {
        $historyboard = "pages.historyboard.";
        Route::view('/index', $historyboard . 'historyboard')->name('historyboard');
    });


    Route::resource(
        '/classroom/{classroom}/student',
        \App\Http\Controllers\classroom\StudentController::class
    )->names('classroom.student');

    Route::resource(
        '/non-register/student',
        \App\Http\Controllers\NonRegister\StudentController::class
    )->names('non-register.student');

    // Export


    // Route::view('/export/history/excel','export.HistoryExcel',['data' => history::with('guest')->get()]);



});
