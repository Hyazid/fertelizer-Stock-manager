<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VentesController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Admin\AchatController;
use App\Http\Controllers\Admin\RestitutionsController;
use App\Http\Controllers\Admin\FacturationsController;
use App\Http\Controllers\Admin\LivraisonsController;
use App\Http\Controllers\Client\BesoinsController;
use App\Http\Controllers\Client\ReceptionController;
use App\Http\Controllers\Client\VentesController as Ventes;
use App\Http\Controllers\Client\DiversController;
use App\Http\Controllers\Client\StockesController;
use App\Http\Controllers\Client\RestitutionController;
use App\Http\Controllers\Client\VenteController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* admin - UCC*/ 
Route::middleware(['auth','role:UCC'])->group(function(){
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/ventes',[VentesController::class,'index'])->name('ventes');
    Route::get ('/achats',[AchatController::class, 'index'])->name('achats');
    Route::get('/restitution',[RestitutionsController::class,'index'])->name('restitutions');
    Route::get('/livraison',[LivraisonsController::class, 'index'])->name('livraisons');
    Route::get('/facturations',[FacturationsController::class, 'index'])->name('facturations');
});
/**UCA-UCC */
Route::middleware(['auth','role:CCLS'])->group(function(){
    Route::get('/dashboard',[DashBoardController::class,'index'])->name('client.dashboard');
    Route::get('/ventes',[VenteController::class,'index'])->name('client.vente');
    Route::get('/divers',[DiversController::class,'index'])->name('client.divers');
    Route::get('/restitutions',[RestitutionController::class,'index'])->name('client.restitution');
    Route::get('/receptions',[ReceptionController::class,'index'])->name('client.receptions');
    Route::get('/stockes',[StockesController::class,'index'])->name('client.stockes');
    Route::get('/besoins',[BesoinsController::class,'index'])->name('client.besoins');
});


require __DIR__.'/auth.php';
