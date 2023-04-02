<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BedController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LaporanPPIController;
use App\Http\Controllers\SurveilansController;
use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\PasienPulangController;
use App\Http\Controllers\PasienDirawatController;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('setting', SettingController::class);
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('master/pasien/data', [MasterPasienController::class, 'data'])->name('pasien.data');
    Route::get('master/pasien/cetak-barcode/{mrn}', [MasterPasienController::class, 'cetakBarcode'])->name('pasien.cetak_barcode');
    Route::resource('master/pasien', MasterPasienController::class);

    Route::get('master/dokter/data', [DokterController::class, 'data'])->name('dokter.data');
    Route::resource('master/dokter', DokterController::class);

    Route::get('master/ruangan/data', [RuanganController::class, 'data'])->name('ruangan.data');
    Route::resource('master/ruangan', RuanganController::class);

    Route::get('master/bed/data', [BedController::class, 'data'])->name('bed.data');
    Route::resource('master/bed', BedController::class);

    Route::post('bedmanagement/pasiendirawat/data', [PasienDirawatController::class, 'data'])->name('pasiendirawat.data');
    Route::post('bedmanagement/pasiendirawat/countbor', [PasienDirawatController::class, 'count_bor'])->name('pasiendirawat.countbor');
    Route::put('bedmanagement/registrasirwi/{id}', [PasienDirawatController::class, 'registrasi'])->name('pasiendirawat.registrasi');
    Route::put('bedmanagement/pindahkamar/{id}', [PasienDirawatController::class, 'pindah'])->name('pasiendirawat.pindah');
    Route::post('bedmanagement/pulang/{id}', [PasienDirawatController::class, 'pulang'])->name('pasiendirawat.pulang');
    Route::resource('bedmanagement/pasiendirawat', PasienDirawatController::class);

    Route::post('bedmanagement/pasienpulang/data', [PasienPulangController::class, 'data'])->name('pasienpulang.data');
    Route::resource('bedmanagement/pasienpulang', PasienPulangController::class);

    Route::post('surveilans/data', [SurveilansController::class, 'data'])->name('surveilans.data');
    Route::resource('surveilans', SurveilansController::class);

    Route::post('surveilans/phlebitis', [SurveilansController::class, 'store_phlebitis'])->name('surveilans.phlebitis');
    Route::put('surveilans/phlebitis/{id}', [SurveilansController::class, 'update_phlebitis'])->name('surveilans.updatephlebitis');
    Route::get('surveilans/phlebitisheader/{id}', [SurveilansController::class, 'show_phlebitis_header'])->name('surveilans.showphlebitisheader');
    Route::get('surveilans/phlebitisdetail/{id}', [SurveilansController::class, 'show_phlebitis_detail'])->name('surveilans.showphlebitisdetail');

    Route::post('surveilans/isk', [SurveilansController::class, 'store_isk'])->name('surveilans.isk');
    Route::put('surveilans/isk/{id}', [SurveilansController::class, 'update_isk'])->name('surveilans.updateisk');
    Route::get('surveilans/iskheader/{id}', [SurveilansController::class, 'show_isk_header'])->name('surveilans.showiskheader');
    Route::get('surveilans/iskdetail/{id}', [SurveilansController::class, 'show_isk_detail'])->name('surveilans.showiskdetail');

    Route::post('surveilans/iadp', [SurveilansController::class, 'store_iadp'])->name('surveilans.iadp');
    Route::put('surveilans/iadp/{id}', [SurveilansController::class, 'update_iadp'])->name('surveilans.updateiadp');
    Route::get('surveilans/iadpheader/{id}', [SurveilansController::class, 'show_iadp_header'])->name('surveilans.showiadpheader');
    Route::get('surveilans/iadpdetail/{id}', [SurveilansController::class, 'show_iadp_detail'])->name('surveilans.showiadpdetail');

    Route::post('surveilans/vap', [SurveilansController::class, 'store_vap'])->name('surveilans.vap');
    Route::put('surveilans/vap/{id}', [SurveilansController::class, 'update_vap'])->name('surveilans.updatevap');
    Route::get('surveilans/vapheader/{id}', [SurveilansController::class, 'show_vap_header'])->name('surveilans.showvapheader');
    Route::get('surveilans/vapdetail/{id}', [SurveilansController::class, 'show_vap_detail'])->name('surveilans.showvapdetail');

    Route::post('surveilans/ido', [SurveilansController::class, 'store_ido'])->name('surveilans.ido');
    Route::put('surveilans/ido/{id}', [SurveilansController::class, 'update_ido'])->name('surveilans.updateido');
    Route::get('surveilans/ido/{id}', [SurveilansController::class, 'show_ido'])->name('surveilans.showido');

    Route::resource('laporanhais', LaporanPPIController::class);
    Route::post('laporanhais/dataphlebitis', [LaporanPPIController::class, 'data_phlebitis'])->name('laporanhais.dataphlebitis');
    Route::post('laporanhais/dataisk', [LaporanPPIController::class, 'data_isk'])->name('laporanhais.dataisk');
    Route::post('laporanhais/dataiadp', [LaporanPPIController::class, 'data_iadp'])->name('laporanhais.dataiadp');
    Route::post('laporanhais/datavap', [LaporanPPIController::class, 'data_vap'])->name('laporanhais.datavap');
    Route::post('laporanhais/dataido', [LaporanPPIController::class, 'data_ido'])->name('laporanhais.dataido');
    Route::post('laporanhais/count', [LaporanPPIController::class, 'count'])->name('laporanhais.count');
    Route::post('laporanhais/countbundle', [LaporanPPIController::class, 'count_bundle'])->name('laporanhais.countbundle');
});
