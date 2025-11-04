<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Survey\SurveyController;
use App\Http\Controllers\Jabatan\JabatanController;
use App\Http\Controllers\Master\MasterLembagaController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Desa\DesaController;
use App\Http\Controllers\Desa\P3\P3Controller;
use App\Http\Controllers\Desa\P3\PegawaiController;
use App\Http\Controllers\Desa\P3\BpdController;
use App\Http\Controllers\Desa\P4\P4Controller;
use App\Http\Controllers\Desa\P5\P5Controller;
use App\Http\Controllers\Desa\P5\P501Controller;
use App\Http\Controllers\Desa\P5\P502Controller;
use App\Http\Controllers\Desa\P5\P503Controller;
use App\Http\Controllers\Desa\P6\P601Controller;
use App\Http\Controllers\Desa\P6\P602Controller;
use App\Http\Controllers\Desa\P6\P603Controller;
use App\Http\Controllers\Desa\P7\P7Controller;
use App\Http\Controllers\Desa\P7\P705Controller;
use App\Http\Controllers\Desa\P8\P8Controller;
use App\Http\Controllers\Desa\P9\P9Controller;
use App\Http\Controllers\Desa\P9\P914Controller;
use App\Http\Controllers\Desa\P9\P923Controller;
use App\Http\Controllers\Desa\P9\P932Controller;
use App\Http\Controllers\Desa\P9\P941Controller;
use App\Http\Controllers\Desa\P10\P10Controller;
use App\Http\Controllers\Individu\P1\P1IdvController;
use App\Http\Controllers\Keluarga\P2\P2KgController;
use App\Http\Controllers\Keluarga\P3\P3KgController;


Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// Register User
// Route::post('/registerweb', [UserController::class, 'registerweb'])->name('registerweb');

// AUTH
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Get User
    Route::resource('userweb', UserController::class);

    // Survey
    Route::resource('survey', SurveyController::class);
    Route::get('/survey/aktif', [SurveyController::class, 'getSurveyAktif']);
    Route::resource('lembaga', MasterLembagaController::class);
    // Jabatan
    // Route::resource('jabatan', JabatanController::class);
    // Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');

    // Jabatan
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');         // tampil list
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');         // simpan baru
    Route::get('/jabatan/{id}', [JabatanController::class, 'show'])->name('jabatan.show');       // detail jabatan
    Route::get('/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');  // form edit
    Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');   // update jabatan
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy'); // hapus jabatan


    // Dashboard & halaman statis
    Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard');
    Route::get('/coba', fn() => view('pages.desa.forms.coba'))->name('coba');
    Route::get('/keluarga', fn() => view('pages.keluarga.keluarga'))->name('keluarga.index');
    Route::get('/individu', fn() => view('pages.individu.individu'))->name('individu.index');

    Route::get('/desa', [DesaController::class, 'index'])->name('desa-p2.index');
    // Wilayah
    Route::get('/provinces', [WilayahController::class, 'provinces']);
    Route::get('/kabupaten/{provinceCode}', [WilayahController::class, 'regencies']);
    Route::get('/kecamatan/{regencyCode}', [WilayahController::class, 'districts']);
    Route::get('/desa/{districtCode}', [WilayahController::class, 'villages']);


    // Tampilkan list desa
    Route::get('/desa-p2', [DesaController::class, 'index'])->name('desa-p2.index');
    // Simpan data baru
    Route::post('/desa-p2', [DesaController::class, 'store'])->name('desa-p2.store');
    // Form edit
    Route::get('/desa-p2/{id}/edit', [DesaController::class, 'edit'])->name('desa-p2.edit');
    // Simpan update
    Route::put('/desa-p2/{id}', [DesaController::class, 'update'])->name('desa-p2.update');
    // Hapus data
    Route::delete('/desa-p2/{id}', [DesaController::class, 'destroy'])->name('desa-p2.destroy');
    // Kirim id_survey dan id_desa
    Route::post('/set-session', [DesaController::class, 'setSession'])->name('session.set');
    Route::get('/set-session/{id}/{form}', [SessionController::class, 'set'])->name('set.session');
    // Kirim id_survey dan id_desa
    Route::post('/set-session', [DesaController::class, 'setSession'])->name('session.set');
    Route::get('/setkg-session/{id}/{form}', [SessionController::class, 'setkg'])->name('setkg.session');
    // DESA P3
    Route::resource('/desa-p3', P3Controller::class);
    // Pegawai
    Route::get('/desa-p3Pegawai/{id_p3}/p3Pegawai', [PegawaiController::class, 'index'])
        ->name('desa-p3Pegawai.index');
    Route::get('/desa-p2/{id_desa}/p3Pegawai', [PegawaiController::class, 'fromP2'])
        ->name('desa-p3Pegawai.fromP2');
    Route::post('/desa-p3Pegawai/store', [PegawaiController::class, 'store'])
        ->name('desa-p3Pegawai.store');
    Route::put('/desa-p3Pegawai/{id}', [PegawaiController::class, 'update'])
        ->name('desa-p3Pegawai.update');
    Route::delete('/desa-p3Pegawai/{id}', [PegawaiController::class, 'destroy'])
        ->name('desa-p3Pegawai.destroy');
    // BPD
    Route::get('/desa-p3Bpd/{id_p3}/p3Bpd', [BpdController::class, 'index'])
        ->name('desa-p3Bpd.index');
    Route::get('/desa-p2/{id_desa}/p3Bpd', [BpdController::class, 'fromP2'])
        ->name('desa-p3Bpd.fromP2');
    Route::post('/desa-p3Bpd/store', [BpdController::class, 'store'])
        ->name('desa-p3Bpd.store');
    Route::put('/desa-p3Bpd/{id}', [BpdController::class, 'update'])
        ->name('desa-p3Bpd.update');
    Route::delete('/desa-p3Bpd/{id}', [BpdController::class, 'destroy'])
        ->name('desa-p3Bpd.destroy');

    Route::resource('desa-p4', P4Controller::class);
    Route::get('/desa-p4/{id}', [P4Controller::class, 'show'])->name('desa-p4.show');
    Route::resource('desa-p5', P5Controller::class);
    // P501
    Route::get('/desa-p5/{id_p5}/p501', [P501Controller::class, 'index'])->name('desa-p501.index');
    Route::get('/desa-p2/{id_desa}/p501', [P501Controller::class, 'fromP2'])->name('desa-p501.fromP2');
    Route::post('/desa-p501/store', [P501Controller::class, 'store'])->name('desa-p501.store');
    Route::delete('/desa-p501/{id}', [P501Controller::class, 'destroy'])->name('desa-p501.destroy');
    Route::put('/desa-p501/{id}', [P501Controller::class, 'update'])->name('desa-p501.update');
    // P502 
    Route::get('/desa-p5/{id_p5}/p502', [P502Controller::class, 'index'])->name('desa-p502.index');
    Route::get('/desa-p2/{id_desa}/p502', [P502Controller::class, 'fromP2'])->name('desa-p502.fromP2');
    Route::post('/desa-p502/store', [P502Controller::class, 'store'])->name('desa-p502.store');
    Route::delete('/desa-p502/{id}', [P502Controller::class, 'destroy'])->name('desa-p502.destroy');
    Route::put('/desa-p502/{id}', [P502Controller::class, 'update'])->name('desa-p502.update');
    // P503
    Route::get('/desa-p5/{id_p5}/p503', [P503Controller::class, 'index'])->name('desa-p503.index');
    Route::get('/desa-p2/{id_desa}/p503', [P503Controller::class, 'fromP2'])->name('desa-p503.fromP2');
    Route::post('/desa-p503/store', [P503Controller::class, 'store'])->name('desa-p503.store');
    Route::delete('/desa-p503/{id}', [P503Controller::class, 'destroy'])->name('desa-p503.destroy');
    Route::put('/desa-p503/{id}', [P503Controller::class, 'update'])->name('desa-p503.update');
    // P601
    Route::resource('desa-p601', P601Controller::class);
    // P602
    Route::resource('desa-p602', P602Controller::class);
    // P603
    Route::resource('desa-p603', P603Controller::class);
    // P7
    Route::resource('desa-p7', P7Controller::class);
    // P705
    Route::get('/desa-p7/{id_p7}/p705', [P705Controller::class, 'index'])->name('desa-p705.index');
    Route::get('/desa-p2/{id_desa}/p705', [P705Controller::class, 'fromP2'])->name('desa-p705.fromP2');
    Route::post('/desa-p705/store', [P705Controller::class, 'store'])->name('desa-p705.store');
    Route::put('/desa-p705/{id}', [P705Controller::class, 'update'])->name('desa-p705.update');
    Route::delete('/desa-p705/{id}', [P705Controller::class, 'destroy'])->name('desa-p705.destroy');
    // P8
    Route::resource('desa-p8', P8Controller::class);
    // P9
    Route::resource('desa-p9', P9Controller::class);
    // P914
    Route::get('/desa-p9/{id_p9}/p914', [P914Controller::class, 'index'])->name('desa-p914.index');
    Route::get('/desa-p2/{id_desa}/p914', [P914Controller::class, 'fromP2'])->name('desa-p914.fromP2');
    Route::post('/desa-p914/store', [P914Controller::class, 'store'])->name('desa-p914.store');
    Route::put('/desa-p914/{id}', [P914Controller::class, 'update'])->name('desa-p914.update');
    Route::delete('/desa-p914/{id}', [P914Controller::class, 'destroy'])->name('desa-p914.destroy');
    // P923
    Route::get('/desa-p9/{id_p9}/p923', [P923Controller::class, 'index'])->name('desa-p923.index');
    Route::get('/desa-p2/{id_desa}/p923', [P923Controller::class, 'fromP2'])->name('desa-p923.fromP2');
    Route::post('/desa-p923/store', [P923Controller::class, 'store'])->name('desa-p923.store');
    Route::put('/desa-p923/{id}', [P923Controller::class, 'update'])->name('desa-p923.update');
    Route::delete('/desa-p923/{id}', [P923Controller::class, 'destroy'])->name('desa-p923.destroy');
    // P932
    Route::get('/desa-p9/{id_p9}/p932', [P932Controller::class, 'index'])->name('desa-p932.index');
    Route::get('/desa-p2/{id_desa}/p932', [P932Controller::class, 'fromP2'])->name('desa-p932.fromP2');
    Route::post('/desa-p932/store', [P932Controller::class, 'store'])->name('desa-p932.store');
    Route::put('/desa-p932/{id}', [P932Controller::class, 'update'])->name('desa-p932.update');
    Route::delete('/desa-p932/{id}', [P932Controller::class, 'destroy'])->name('desa-p932.destroy');
    // P941
    Route::get('/desa-p9/{id_p9}/p941', [P941Controller::class, 'index'])->name('desa-p941.index');
    Route::get('/desa-p2/{id_desa}/p941', [P941Controller::class, 'fromP2'])->name('desa-p941.fromP2');
    Route::post('/desa-p941/store', [P941Controller::class, 'store'])->name('desa-p941.store');
    Route::put('/desa-p941/{id}', [P941Controller::class, 'update'])->name('desa-p941.update');
    Route::delete('/desa-p941/{id}', [P941Controller::class, 'destroy'])->name('desa-p941.destroy');
    // P10
    Route::resource('desa-p10', P10Controller::class);

    // KG P2
    Route::get('/kg-p2', [P2KgController::class, 'index'])->name('kg-p2.index');
    Route::post('/kg-p2/store', [P2KgController::class, 'store'])->name('kg-p2.store');
    Route::put('/kg-p2/{id}', [P2KgController::class, 'update'])->name('kg-p2.update');
    Route::delete('/kg-p2/{id}', [P2KgController::class, 'destroy'])->name('kg-p2.destroy');
    // Route::resource('/keluarga/p2', P2KgController::class);
    // KG P3
    Route::get('/kg-p3', [P3KgController::class, 'index'])->name('kg-p3.index');
    Route::post('/kg-p3/store', [P3KgController::class, 'store'])->name('kg-p3.store');
    Route::put('/kg-p3/{id}', [P3KgController::class, 'update'])->name('kg-p3.update');
    Route::delete('/kg-p3/{id}', [P3KgController::class, 'destroy'])->name('kg-p3.destroy');
    // Route::resource('keluarga/p3', P10Controller::class);



    // INDIVIDU P1 
    Route::get('/idv-p1', [P1IdvController::class, 'index'])->name('idv-p1.index');
    Route::post('/idv-p1/store', [P1IdvController::class, 'store'])->name('idv-p1.store');
    Route::put('/idv-p1/{id}', [P1IdvController::class, 'update'])->name('idv-p1.update');
    Route::delete('/idv-p1/{id}', [P1IdvController::class, 'destroy'])->name('idv-p1.destroy');
});
