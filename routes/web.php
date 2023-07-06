<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
    return redirect('login');
});

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
//Route pertanyaan no 1
Route::resource('employees', EmployeeController::class)->middleware('auth');
Route::get('profile', ProfileController::class)->name('profile')->middleware('auth');

Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate']);
//local disk
Route::get('/local-disk', function() {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
    return asset('storage/local-example.txt');
});

//public disk
Route::get('/public-disk', function() {
    Storage::disk('public')->put('public-example.txt', 'This is public example content');
    return asset('storage/public-example.txt');
});

//retrieve local file
Route::get('/retrieve-local-file', function() {
    if (Storage::disk('local')->exists('local-example.txt')) {
        $contents = Storage::disk('local')->get('local-example.txt');
    } else {
        $contents = 'File does not exist';
    }
    return $contents;
});

//retrieve publice file
Route::get('/retrieve-public-file', function() {
    if (Storage::disk('public')->exists('public-example.txt')) {
        $contents = Storage::disk('public')->get('public-example.txt');
    } else {
        $contents = 'File does not exist';
    }

    return $contents;
});

//download local file
Route::get('/download-local-file', function() {
    return Storage::download('local-example.txt', 'local file');
});

//download public file
Route::get('/download-public-file', function() {
    return Storage::download('public/public-example.txt', 'public file');
});

//Menampilkan URL
Route::get('/file-url', function() {
    // Just prepend "/storage" to the given path and return a relative URL
    $url = Storage::url('local-example.txt');
    return $url;
});

//Menampilkan Size File
Route::get('/file-size', function() {
    $size = Storage::size('local-example.txt');
    return $size;
});

//Menampilkan Path file
Route::get('/file-path', function() {
    $path = Storage::path('local-example.txt');
    return $path;
});

//Upload file
Route::get('/upload-example', function() {
    return view('upload_example');
});

Route::post('/upload-example', function(Request $request) {
    $path = $request->file('avatar')->store('public');
    return $path;
})->name('upload-example');

//delete file
Route::get('/delete-local-file', function(Request $request) {
    Storage::disk('local')->delete('local-example.txt');
    return 'Deleted';
});

Route::get('/delete-public-file', function(Request $request) {
    Storage::disk('public')->delete('public-example.txt');
    return 'Deleted';
});

//Download File
Route::get('download-file/{employeeId}', [EmployeeController::class, 'downloadFile'])->name('employees.downloadFile');
