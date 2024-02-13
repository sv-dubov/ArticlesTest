<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/change-language/{lang_code}', [LanguageController::class, 'changeLanguage'])->name('change_lang');

Route::group(['middleware' => 'language'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/articles', [FrontArticleController::class, 'index'])->name('front.articles.index');
    Route::get('/articles/{article}', [FrontArticleController::class, 'show'])->name('front.articles.show');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('/categories', CategoryController::class)->except('show');
        Route::resource('/articles', AdminArticleController::class)->except('show');
        Route::post('/galleries/{gallery}/images/{image}', [GalleryController::class, 'deleteImage'])->name('galleries.images.delete');
        Route::resource('/galleries', GalleryController::class)->except('show');
    });
});
