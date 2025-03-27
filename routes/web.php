<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardAdminPostController;

Route::get('/', [HomeController::class, 'index']);


Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/comments', [PostController::class, 'simpanKomentar']);

Route::get('/dashboard/users/{user}', [UserController::class, 'index'])->middleware('auth');
Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


Route::post('/dashboard/posts/category', [DashboardPostController::class, 'simpanKategori'])->middleware('auth');
Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy']);

Route::get('/dashboard/admin/posts/verifikasi/{post}', [DashboardAdminPostController::class, 'verifikasi'])->middleware(['auth', 'admin']);
Route::put('/dashboard/admin/posts/verifikasi/{post}', [DashboardAdminPostController::class, 'verified'])->middleware(['auth', 'admin']);
Route::put('/dashboard/admin/posts/verifikasi/not-verified/{post}', [DashboardAdminPostController::class, 'notVerified'])->middleware(['auth', 'admin']);

Route::resource('/dashboard/admin/categories', DashboardCategoryController::class)->middleware(['auth', 'admin']);

Route::resource('/dashboard/admin/users', DashboardUserController::class)->middleware(['auth', 'admin']);

Route::resource('/dashboard/admin/posts', DashboardAdminPostController::class)->middleware(['auth', 'admin'])->except('create')->names('admin.posts');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');