<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\SparepartController;  

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('user/home', [HomeController::class, 'home'])->name('user.home');


// Route::get('spv/home', [HomeController::class, 'spvHome'])->name('spv.home');

 
// Protected Admin route
Route::group(["middleware" => ["is_admin"]], function(){
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
    //userController
    Route::resource('users', UserController::class)->middleware('is_admin');
    Route::get('/user/cari',[UserController::class, 'cari'])->middleware('is_admin');

    //outletController
    Route::resource('outlets', OutletController::class);
    Route::get('outlet/indexAdmin',[OutletController::class, 'indexAdmin'])->name('outlet.indexAdmin');
    Route::get('outlet/list',[OutletController::class, 'getOutlets'])->name('outlet.list');
    Route::get('/outlet/cari',[OutletController::class, 'cari']);
    Route::get('/outlet/detail',[OutletController::class, 'detailOutlet']);

    //mesinController
    Route::resource('mesins', MesinController::class);
    Route::get('mesin/indexAdmin',[MesinController::class, 'indexAdmin'])->name('mesins.indexAdmin');    
    Route::get('/mesin/cari',[MesinController::class, 'cari']);

   //PerbaikanController
   Route::resource('perbaikans', PerbaikanController::class);
   Route::get('perbaikan/indexAdmin',[PerbaikanController::class, 'indexAdmin'])->name('perbaikan.indexAdmin');    
   Route::get('/perbaikan/cari',[PerbaikanController::class, 'cari']);

   //SparepartController
    Route::resource('spareparts', SparepartController::class);
    Route::get('sparepart/indexAdmin',[SparepartController::class, 'indexAdmin'])->name('spareparts.indexAdmin');    
    Route::get('/sparepart/cari',[SparepartController::class, 'cari']);

 });

  //protected spv route
 Route::group(["middleware" => ["is_spv"]], function(){
    Route::get('spv/home', [HomeController::class, 'spvHome'])->name('spv.home');
 });

 //protected user route
 Route::group(["middleware" => ["is_user"]], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('user/home', [HomeController::class, 'home'])->name('user.home');
 });
