<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [ HomeController::class, 'index' ])->name('home');

//Upload Image
Route::post('image-upload', [ ImageUploadController::class, 'upload' ])->name('image.upload');

//Merge images
Route::get('/image/convert/{id}', [ ImageUploadController::class, 'convert'])->name('image.convert');

//Show single image
Route::get('/image/show/{id}', [ ImageUploadController::class, 'show'])->name('image.show');

//Download image
Route::get('/image/download/{url}', [ ImageUploadController::class, 'download'])->name('image.download');

//Delete image
Route::delete('/image/delete/{id}', [ ImageUploadController::class, 'destroy'])->name('image.delete');

Route::delete('/image/opnieuw/{id}', [ ImageUploadController::class, 'opnieuw'])->name('image.opnieuw');



Route::get('/bibliotheek', [ HomeController::class, 'bibliotheek'])->name('bibliotheek');
