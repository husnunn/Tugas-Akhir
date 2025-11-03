<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Keluarga\P3\P3Api;
use App\Http\Controllers\Api\Wilayah\WilayahApi;
use App\Http\Controllers\Api\Survey\SurveyApi;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("getuser", [ApiController::class, "getdatauser"]);
    Route::get("logout", [ApiController::class, "logout"]);
    Route::get("refresh-token", [ApiController::class, "refreshToken"]);
    // Wilayah
    Route::get('/wilayah/provinces', [WilayahApi::class, 'provinces']);
    Route::get('/wilayah/kabupaten/{provinceCode}', [WilayahApi::class, 'regencies']);
    Route::get('/wilayah/kecamatan/{regencyCode}', [WilayahApi::class, 'districts']);
    Route::get('/wilayah/desa/{districtCode}', [WilayahApi::class, 'villages']);
    // SURVEY
    Route::get('/survey/all', [SurveyApi::class, 'index']);
    Route::get('/survey/aktif', [SurveyApi::class, 'getSurveyAktif']);


    // KELUARGA P2
    // KELUARGA P3
    Route::resource('/keluarga/p3', P3Api::class);
    // KELUARGA P4
    // KELUARGA P421
    // KELUARGA P422
    // KELUARGA P423
    // KELUARGA P424
});
