<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManualLinkingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    
Route::get('/manual-linking', [ManualLinkingController::class, 'manualLinkingWithSelection'])->name('manual.linking');
Route::get('/upload-form', [ManualLinkingController::class, 'showForm'])->name('upload-form');
Route::post('/upload', [ManualLinkingController::class , 'upload'])->name('upload');
Route::post('/saveMappingData', [ManualLinkingController::class, 'saveMappingData']);

// Permission Routes
Route::get('/assign-roles-permissions', [PermissionController::class, 'showForm'])->name('show.assign.roles.permissions');
Route::post('/assign-roles-permissions', [PermissionController::class, 'assign'])->name('assign.roles.permissions');

// Additional Mapping Routes
Route::get('/all-mappings', [ManualLinkingController::class, 'getAllMappings'])->name('all-mapping');
Route::get('/getDropdownData', [ManualLinkingController::class, 'getDropdownData']);

});


// Authentication Routes
Route::get('/',[LoginController::class,'index']);
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



