<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\KodeSuratController;
use App\Http\Controllers\LogActionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SuratController;
use App\Models\Departement;
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
Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::post('/register', [RegisterController::class, 'store']);
// Route::get('/register-user', [RegisterController::class, 'create']);
Route::get('/view-detail', [SuratController::class, 'detail'])->name('view-detail');
Route::get('/share-qr', [SuratController::class, 'share'])->name('share-qr');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
	Route::post('/update-setting', [InformasiController::class, 'update'])->name('update-setting');
	Route::post('/upload-image', [InformasiController::class, 'imageStore'])->name('upload-image');

	Route::get('/hal-surat', [KodeSuratController::class, 'index'])->name('hal-surat');
	Route::post('/tambah-hal-surat', [KodeSuratController::class, 'store'])->name('tambah-hal-surat');
	Route::post('/update-hal-surat/{id}', [KodeSuratController::class, 'update'])->name('update-hal-surat');
	Route::get('/delete-hal-surat/{id}', [KodeSuratController::class, 'destroy'])->name('delete-hal-surat');

	Route::get('/departement', [DepartementController::class, 'index'])->name('departement');
	Route::post('/tambah-departement', [DepartementController::class, 'store'])->name('tambah-departement');
	Route::post('/update-departement/{id}', [DepartementController::class, 'update'])->name('update-departement');
	Route::get('/delete-departement/{id}', [DepartementController::class, 'destroy'])->name('delete-departement');

	Route::get('/log/{id}', [SuratController::class, 'logSurat'])->name('log');
	Route::get('/surat-list', [SuratController::class, 'index'])->name('surat-list');
	Route::get('/surat-validasi', [SuratController::class, 'indexValidasi'])->name('surat-validasi');
	Route::get('/surat-validasi-pimpinan', [SuratController::class, 'indexValidasiPimpinan'])->name('surat-validasi-pimpinan');
	Route::post('/tambah-surat', [SuratController::class, 'store'])->name('tambah-surat');
	Route::post('/update-surat/{id}', [SuratController::class, 'update'])->name('update-surat');
	Route::post('/update-file/{id}', [SuratController::class, 'updateSurat'])->name('update-file');
	Route::get('/delete-surat/{id}', [SuratController::class, 'destroy'])->name('delete-surat');
	Route::post('/updateStatus/{id}', [SuratController::class, 'updateStatus'])->name('updateStatus');
	Route::post('/updateStatusPimpinan/{id}', [SuratController::class, 'updateStatusPimpinan'])->name('updateStatusPimpinan');
	Route::get('/laporan', [SuratController::class, 'export_excel'])->name('laporan');
	Route::get('/ajukan-kembali/{id}', [SuratController::class, 'ajukanSurat'])->name('ajukan-kembali');
	
	
    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-management', [InfoUserController::class, 'userManagement'])->name('user-management');
	Route::post('/tambah-user', [InfoUserController::class, 'tambahUser'])->name('tambah-user');
	Route::post('/update-user/{id}', [InfoUserController::class, 'updateUser'])->name('update-user');
	Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser'])->name('delete-user');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');


	Route::post('/password-update', [ResetController::class, 'changePassword'])->name('password-update');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login-post', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');