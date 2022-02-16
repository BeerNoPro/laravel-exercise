<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UploadfileController;
use App\Http\Controllers\AjaxCrudTodoController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LoginFacebookController;
use App\Http\Controllers\LoginGoogleController;


Route::get('/', function () {
    return view('welcome');
});

// // Route example resource controller
// Route::resource('posts', PostController::class);

// Route group students
Route::prefix('students')->group(function () {
    // Route render list student
    Route::get('/', [StudentController::class, 'index'])->name('students.list');
    
    // Route insert new student
    Route::post('/student_create', [StudentController::class, 'store'])->name('students.store');
    
    // Route create return view form add
    Route::get('/student_add', [StudentController::class, 'create'])->name('students.add');
    
    // Route show detail student
    Route::get('/student_show/{id}', [StudentController::class, 'show'])->name('students.show');
    
    // Route delete student
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.delete');
    
    // Route get info edit student
    Route::get('/student_update/{id}', [StudentController::class, 'edit'])->name('students.edit');
    
    // Route update student
    Route::post('/student_update/{id}', [StudentController::class, 'update'])->name('students.update');

});

// Route group upload files
Route::prefix('upload-file')->group(function () {
    // Route list images s3
    Route::get('/images-list', [UploadfileController::class, 'index'])->name('images-list');
    
    // Route create form upload file
    Route::get('/upload-file', [UploadfileController::class, 'create'])->name('upload-file');
    
    // Route store file
    Route::post('/upload-file', [UploadfileController::class, 'store'])->name('upload-file');
    
    // Route deleted
    Route::delete('/delete-file/{image}', [UploadfileController::class, 'destroy'])->name('delete-file');
    // Route::delete('/image/{image}', [UploadfileController::class, 'destroy']);
});

// Route ajax crud to do list
Route::prefix('ajax-crud')->group(function () {
    Route::get('ajax-crud-todo', [AjaxCrudTodoController::class, 'index']);
    
    Route::post('add-update-ajax', [AjaxCrudTodoController::class, 'store']);
    
    Route::post('delete-ajax/{id}', [AjaxCrudTodoController::class, 'destroy']);
    
    Route::get('edit-ajax/{id}', [AjaxCrudTodoController::class, 'edit']);
});

// Custom Authentication...
Route::prefix('handle-auth')->group(function () {
    Route::get('/dashboard', [CustomAuthController::class, 'dashboard']);
    Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('/custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
    Route::get('/registration', [CustomAuthController::class, 'registration'])->name('register-user');
    Route::post('/custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

    // Facebook Login URL
    Route::get('/facebook', [LoginFacebookController::class, 'loginUsingFacebook'])->name('facebook');
    Route::get('/callbackFromFacebook', [LoginFacebookController::class, 'callbackFromFacebook'])->name('callbackFromFacebook');
    
    // Google login url
    Route::get('/google', [LoginGoogleController::class, 'loginWithGoogle'])->name('google');
    Route::any('/callbackFromGoogle', [LoginGoogleController::class, 'callbackFromGoogle'])->name('callbackFromGoogle');
});
