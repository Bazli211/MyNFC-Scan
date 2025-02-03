<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FineStatusController;

Route::get('/nfc-scan', function () {
    return view('frontend'); // Assuming frontend.blade.php is your NFC scanner
})->name('nfc.scan');




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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//loginController
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//studentController
Route::get('/student/dashboard', function () {
    return view('student.dashboard'); // Create a view for the student dashboard
})->name('student.dashboard')->middleware('auth');

Route::get('/police/dashboard', function () {
    return view('police.dashboard'); // Create a view for the police dashboard
})->name('police.dashboard')->middleware('auth');

//profile student
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [StudentController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
});

//fine
Route::middleware(['auth'])->group(function () {
    // Show all fines (index)
    Route::get('fines', [FineController::class, 'index'])->name('fines.index');

    // Show create form for a new fine in manual format
    Route::get('fines/manual', [FineController::class, 'manual'])->name('fines.manual');

    // Show create form for a new fine
    Route::get('fines/create', [FineController::class, 'create'])->name('fines.create');

    // Store a new fine
    Route::post('fines', [FineController::class, 'store'])->name('fines.store');

    // Show a specific fine
    Route::get('/fines/{fine}', [FineController::class, 'show'])->name('fines.show');

    // Show edit form for a specific fine
    Route::get('fines/{fine}/edit', [FineController::class, 'edit'])->name('fines.edit');

    // Update a specific fine
    Route::put('fines/{fine}', [FineController::class, 'update'])->name('fines.update');

    // Delete a specific fine
    Route::delete('fines/{fine}', [FineController::class, 'destroy'])->name('fines.destroy');
    
    // Scan for the fine
    Route::post('/scan', [FineController::class, 'scan'])->name('fines.scan')->middleware('web');
});

//vehicles
Route::middleware(['auth'])->group(function () {
    // Show all vehicles (index)
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

    // Show create form
    Route::get('vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');

    // Store a new vehicle
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

    // Show a specific vehicle
    Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

    // Show edit form for a specific vehicle
    Route::get('vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

    // Update a specific vehicle
    Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');

    // Delete a specific vehicle
    Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
});

//sticker
// Student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/stickers', [StickerController::class, 'index'])->name('stickers.index');
    Route::get('/stickers/create', [StickerController::class, 'create'])->name('stickers.create');
    Route::post('/stickers', [StickerController::class, 'store'])->name('stickers.store');
    Route::get('/stickers/{unique_id}/renew', [StickerController::class, 'renew'])->name('stickers.renew');
});


// Police routes
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/police/stickers', [StickerController::class, 'policeIndex'])->name('police.stickers.index');
    Route::get('/police/stickers/{id}', [StickerController::class, 'show'])->name('police.stickers.show');
    Route::post('/police/stickers/{unique_id}/approve', [StickerController::class, 'approve'])->name('police.stickers.approve');
    Route::post('/police/stickers/{unique_id}/reject', [StickerController::class, 'reject'])->name('police.stickers.reject');

});

//write NFC
Route::get('/nfc/write', function () {
    return view('NFCWrite');
})->name('nfc.write')->middleware('auth');

//fine status controller
Route::get('/fine-status', [FineStatusController::class, 'index'])->name('fine_status.index');
Route::get('/fine-status/{id}', [FineStatusController::class, 'show'])->name('fine_status.show');






