<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Back\DashboardController as BackDashboardController;
use App\Http\Controllers\Back\NewsController as BackNewsController;
use App\Http\Controllers\Back\PartnerLinkController as BackPartnerLinkController;
use App\Http\Controllers\Back\UserController as BackUserController;
use App\Http\Controllers\Back\MessageController as BackMessageController;
use App\Http\Controllers\Back\SettingController as BackSettingController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('back')->name('back.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [BackDashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/visitor-stat', [BackDashboardController::class, 'visistorStat'])->name('visitor.stat');

        Route::get('/news', [BackDashboardController::class, 'news'])->name('news');
        Route::get('/news-stat', [BackDashboardController::class, 'stat'])->name('news.stat');
    });

    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/category', [BackNewsController::class, 'category'])->name('category');
        Route::post('/category', [BackNewsController::class, 'categoryStore'])->name('category.store');
        Route::put('/category/edit/{id}', [BackNewsController::class, 'categoryUpdate'])->name('category.update');
        Route::delete('/category/delete/{id}', [BackNewsController::class, 'categoryDestroy'])->name('category.destroy');

        Route::get('/', [BackNewsController::class, 'index'])->name('index');
        Route::get('/create', [BackNewsController::class, 'create'])->name('create');
        Route::post('/create', [BackNewsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BackNewsController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BackNewsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackNewsController::class, 'destroy'])->name('destroy');

        Route::get('/comment', [BackNewsController::class, 'comment'])->name('comment');
        Route::post('/comment/spam/{id}', [BackNewsController::class, 'commentSpam'])->name('comment.spam');
    });


    Route::prefix('partner-link')->name('partner-link.')->group(function () {
        Route::get('/', [BackPartnerLinkController::class, 'index'])->name('index');
        Route::post('/create', [BackPartnerLinkController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [BackPartnerLinkController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackPartnerLinkController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [BackUserController::class, 'index'])->name('index');
        Route::get('/create', [BackUserController::class, 'create'])->name('create');
        Route::post('/create', [BackUserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BackUserController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BackUserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BackUserController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('message')->name('message.')->group(function () {
        Route::get('/', [BackMessageController::class, 'index'])->name('index');
        Route::delete('/{id}', [BackMessageController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/website', [BackSettingController::class, 'website'])->name('website');
        Route::put('/website', [BackSettingController::class, 'websiteUpdate'])->name('website.update');
        Route::put('/website/info', [BackSettingController::class, 'informationUpdate'])->name('website.info');
    });
});
