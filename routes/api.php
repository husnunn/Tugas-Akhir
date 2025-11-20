<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Individu\P1\P1IdvApi;
use App\Http\Controllers\Api\Individu\P2\P204IdvApi;
use App\Http\Controllers\Api\Individu\P2\P2IdvApi;
use App\Http\Controllers\Api\Individu\P4\P401IdvApi;
use App\Http\Controllers\Api\Individu\P4\P402IdvApi;
use App\Http\Controllers\Api\Individu\P4\P4IdvApi;
use App\Http\Controllers\Api\Individu\P5\P5IdvApi;
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
    Route::get('/keluarga/p3/by-p2/{id}', [P3Api::class, 'showByIdP2']);
    // KELUARGA P4
    Route::resource('/keluarga/p4', P4Api::class);
    Route::get('/keluarga/p4/by-p2/{id}', [P4Api::class, 'showByIdP2']);
    // KELUARGA P421
    Route::resource('/keluarga/p421', P421Api::class);
    Route::get('/keluarga/p421/by-p2/{id}', [P421Api::class, 'showByIdP2']);
    // KELUARGA P422
    Route::resource('/keluarga/p422', P422Api::class);
    Route::get('/keluarga/p422/by-p2/{id}', [P422Api::class, 'showByIdP2']);
    // KELUARGA P423
    Route::resource('/keluarga/p423', P423Api::class);
    Route::get('/keluarga/p423/by-p2/{id}', [P423Api::class, 'showByIdP2']);
    // KELUARGA P424
    Route::resource('/keluarga/p424', P424Api::class);
    Route::get('/keluarga/p424/by-p2/{id}', [P424Api::class, 'showByIdP2']);

    // INDIVIDU P1
    Route::resource('/individu/p1', P1IdvApi::class);
    // INDIVIDU P2
    Route::resource('/individu/p2', P2IdvApi::class);
    Route::get('/individu/p2/by-p1/{id}', [P2IdvApi::class, 'showByIdP1']);
    // INDIVIDU P204
    Route::resource('/individu/p204', P204IdvApi::class);
    Route::get('/individu/p204/by-p1/{id}', [P204IdvApi::class, 'showByIdP1']);
    // INDIVIDU P4
    Route::resource('/individu/p4', P4IdvApi::class);
    Route::get('/individu/p4/by-p1/{id}', [P4IdvApi::class, 'showByIdP1']);
    // INDIVIDU P401
    Route::resource('/individu/p401', P401IdvApi::class);
    Route::get('/individu/p401/by-p1/{id}', [P401IdvApi::class, 'showByIdP1']);
    // INDIVIDU P402
    Route::resource('/individu/p402', P402IdvApi::class);
    Route::get('/individu/p402/by-p1/{id}', [P402IdvApi::class, 'showByIdP1']);
    // INDIVIDU P5
    Route::resource('/individu/p5', P5IdvApi::class);
    Route::get('/individu/p5/by-p1/{id}', [P5IdvApi::class, 'showByIdP1']);
});
