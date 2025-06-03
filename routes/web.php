<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VentesController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Admin\AchatController;
use App\Http\Controllers\Admin\RestitutionsController;
use App\Http\Controllers\Admin\FacturationsController;
use App\Http\Controllers\Admin\LivraisonsController;
use App\Http\Controllers\Client\DashBoardControllerCCLS;
use App\Http\Controllers\Client\BesoinsController;
use App\Http\Controllers\Client\ReceptionController;
use App\Http\Controllers\Client\VentesController as Ventes;
use App\Http\Controllers\Client\DiversController;
use App\Http\Controllers\Client\StockesController;
use App\Http\Controllers\Client\RestitutionController;
use App\Http\Controllers\Admin\StockController;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',function(){
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/* admin - UCC*/ 
Route::middleware(['auth','role:UCC'])->group(function(){
    Route::get('/admin/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/ventes',[VentesController::class,'index'])->name('ventes');
    Route::get ('/achats',[AchatController::class, 'index'])->name('achats');
    Route::get('/restitution',[RestitutionsController::class,'index'])->name('restitutions');
    Route::get('/livraison',[LivraisonsController::class, 'index'])->name('livraisons');
    Route::get('/facturations',[FacturationsController::class, 'index'])->name('facturations');
    Route::get('/stock',[StockController::class ,'index'])->name('stock');
    Route::post('/stock',[StockController::class,'store'])->name('stock.store');
    Route::put('/stock/{id}',[StockController::class ,'update'])->name('stock.update');
    Route::get('/export_products',function(){
        return Excel::download(new ProductExport,'listProduit.xlsx');
    })->name('stock.export');
    Route::post('/vente', [VentesController::class, 'store'])->name('ventes.store');
    Route::post('/achat',[AchatController::class,'store'])->name('achats.store');
    Route::delete('/vente', [VentesController::class,'destroy'])->name('ventes.destroy');
});
/**UCA-UCC */
Route::middleware(['auth','role:CCLS'])->group(function(){
    //Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    Route::get('clients/ccls/dashboard',[DashBoardControllerCCLS::class,'index'])->name('client.dashboard');
   
});


require __DIR__.'/auth.php';
