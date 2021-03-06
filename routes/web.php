<?php

use App\Http\Controllers\exportPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return view("app");
    return redirect('/admin/switch');
});

//系统应用
Route::get('{admin}/{path?}', function () {
    return view('admin');
})->where('admin', 'admin|auth')->where('path', '.*');

Route::get("carreport/{carreport}/exportpdf", [exportPdfController::class, 'exportpdf'])->name('carreport.exportpdf');
Route::get("chargingreport/{chargingreport}/exportpdf", [exportPdfController::class, 'exportChargingPdf']);
