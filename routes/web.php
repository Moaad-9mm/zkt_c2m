<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController ;
use App\Http\Controllers\Personnel\{
    PersonnelDepartementController , 
    PersonnelPositionController ,
    PersonnelZoneController ,
    PersonnelEmployeController,
    PersonnelDemissionerController ,
};
use App\Http\Controllers\Presence\{
    PresenceSemaineController ,
    PointageAujourdController ,
} ;
use App\Http\Controllers\Export\{
    DepartementExportController ,
    PositionExportImportController ,
    ZoneExportImportController ,
    EmployeeExportImportController,
};





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

// *********Home*************
Route::get('/',[HomeController::class,'index'])->name('Globalindex');
// *********End Home*************



// *********Departement*************
Route::resource('departements', PersonnelDepartementController::class);
// --------export Departement -------- 
Route::get('exportDepartement/',[DepartementExportController::class, 'export'])->name('export-departement') ;
// --------import Departement -------- 
Route::post('importDepartement/',[DepartementExportController::class, 'import'])->name('import-departement') ;
// ------Departement Modele Dowload -------
Route::get('dowloadDepartementModele',function(){
    $file = public_path()."/DepartementModele.xlsx" ;
    $headers = ['Content-Type: application/vnd.ms-excel'];
    return Response::download($file,"DepartementModele.xlsx", $headers);
}) ;
// *********End Departement*************



// *********Position*************
Route::resource('positions', PersonnelPositionController::class);
// ------Position Modele Dowload -------
Route::get('dowloadPositionModele',function(){
    $file = public_path()."/PositionModele.xlsx" ;
    $headers = ['Content-Type: application/vnd.ms-excel'];
    return Response::download($file,"PositionModele.xlsx", $headers);
}) ;
// --------export Position -------- 
Route::get('exportPosition/',[PositionExportImportController::class, 'export'])->name('export-position') ;
// --------import Position -------- 
Route::post('importPosition/',[PositionExportImportController::class, 'import'])->name('import-position') ;
// *********End Position*************



// *********Zone*************
Route::resource('zones', PersonnelZoneController::class);
// ------Zone Modele Dowload -------
Route::get('dowloadZoneModele',function(){
    $file = public_path()."/ZoneModele.xlsx";
    $headers = ['Content-Type: application/vnd.ms-excel'];
    return Response::download($file,"ZoneModele.xlsx", $headers);
}) ;
// --------export Zone -------- 
Route::get('exportZone/',[ZoneExportImportController::class, 'export'])->name('export-zone') ;
// --------import Zone -------- 
Route::post('importZone/',[ZoneExportImportController::class, 'import'])->name('import-zone') ;
// *********End Zone*************



// *********Employee*************
Route::resource('employees', PersonnelEmployeController::class);
// ------Employee Modele Dowload -------
Route::get('dowloadEmployeeModele',function(){
    $file = public_path()."/EmployeeModele.xlsx";
    $headers = ['Content-Type: application/vnd.ms-excel'];
    return Response::download($file,"EmployeeModele.xlsx", $headers);
}) ;
// --------export Employees -------- 
Route::get('exportEmployee/',[EmployeeExportImportController::class, 'export'])->name('export-employee') ;
// --------import Zone -------- 
// Route::post('importZone/',[ZoneExportImportController::class, 'import'])->name('import-zone') ;
// *********End Employee*************

// *********Demissioner*************
Route::resource('demissiones', PersonnelDemissionerController::class);
// ------Zone Modele Dowload -------
// Route::get('dowloadZoneModele',function(){
//     $file = public_path()."/ZoneModele.xlsx";
//     $headers = ['Content-Type: application/vnd.ms-excel'];
//     return Response::download($file,"ZoneModele.xlsx", $headers);
// }) ;
// --------export Zone -------- 
// Route::get('exportZone/',[ZoneExportImportController::class, 'export'])->name('export-zone') ;
// --------import Zone -------- 
// Route::post('importZone/',[ZoneExportImportController::class, 'import'])->name('import-zone') ;
// *********End Demissioner*************

// ******Presence de Semaine ********
Route::get('presence-semaine' , [PresenceSemaineController::class , 'index'])->name('presence-semaine') ;
Route::post('paring' , [PresenceSemaineController::class , 'search'])->name('search-paring') ;
// **********End Presence De Semaine *****

// ******Presence de Semaine ********
Route::get('pointage-aujour' , [PointageAujourdController::class , 'index'])->name('pointage-aujour') ;
Route::post('pointage' , [PointageAujourdController::class , 'search'])->name('search-pointage-aujour') ;
// **********End Presence De Semaine *****

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
