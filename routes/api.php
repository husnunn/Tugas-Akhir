<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\SurveyController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post("register",[ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("getuser", [ApiController::class, "getdatauser"]);
    Route::get("logout", [ApiController::class, "logout"]);
    Route::get("refresh-token", [ApiController::class, "refreshToken"]);
});


// Route::get('/desa-p2', [DesaController::class, 'index'])->name('desa-p2.index');
// Route::get('/desa-p2/create', [DesaController::class, 'create'])->name('desa-p2.create');
// Route::post('/desa-p2', [DesaController::class, 'store'])->name('desa-p2.store');
// Route::get('/desa-p2/{id}/edit', [DesaController::class, 'edit'])->name('desa-p2.edit');
// Route::put('/desa-p2/{id}', [DesaController::class, 'update'])->name('desa-p2.update');
// Route::delete('/desa-p2/{id}', [DesaController::class, 'destroy'])->name('desa-p2.destroy');
// Route::resource('survey', SurveyController::class);
