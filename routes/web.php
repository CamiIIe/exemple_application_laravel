<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

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

Route::get('/candidates',[CandidateController::class, "all"])->name('candidates');
Route::get('/candidates/{id}',[CandidateController::class, "findById"]);
Route::post('/candidates',[CandidateController::class, "create"])->name('create.candidate');
Route::post('/candidates/update/{id}',[CandidateController::class, "update"])->name('update.candidate');
Route::post('/candidates/delete/{id}',[CandidateController::class, "delete"])->name('delete.candidate');
