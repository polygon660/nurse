<?php

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



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('pages.dashboard.dashboard');
// })->name('dashboard');

Route::view('/dashboard', 'pages.dashboard.dashboard')->name('dashboard');

Route::prefix('setting')->name('setting.')->group(function () {
    $setting = "pages.setting.";
    Route::view('/role', $setting.'role')->name('roles');
    Route::view('/drug', $setting.'drug')->name('drugs');
    Route::view('/medic', $setting.'medic')->name('medics');
    Route::view('/type', $setting.'type')->name('type');
    Route::view('/prefix', $setting.'prefix')->name('prefix');
});

Route::prefix('workspace')->name('workspace.')->group(function () {
    $workspace = "pages.workspace.";
    Route::view('/index', $workspace.'workspace')->name('workspaces');
});
Route::prefix('registryguest')->name('registryguest.')->group(function () {
    $registryguest = "pages.registryguest.";
    Route::view('/index', $registryguest.'registryguest')->name('registryguests');
});
