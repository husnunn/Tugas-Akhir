<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Keluarga\P2\P2Api;
use App\Http\Controllers\Api\Keluarga\P3\P3Api;
use App\Http\Controllers\Api\Keluarga\P4\P421Api;
use App\Http\Controllers\Api\Keluarga\P4\P422Api;
use App\Http\Controllers\Api\Keluarga\P4\P423Api;
use App\Http\Controllers\Api\Keluarga\P4\P424Api;
use App\Http\Controllers\Api\Keluarga\P4\P4Api;
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
    Route::resource('/keluarga/p2', P2Api::class);
    // KELUARGA P3
    Route::resource('/keluarga/p3', P3Api::class);
    // KELUARGA P4
    Route::resource('/keluarga/p4', P4Api::class);
    // KELUARGA P421
    Route::resource('/keluarga/p421', P421Api::class);
    // KELUARGA P422
    Route::resource('/keluarga/p422', P422Api::class);
    // KELUARGA P423
    Route::resource('/keluarga/p423', P423Api::class);
    // KELUARGA P424
    Route::resource('/keluarga/p424', P424Api::class);
});
