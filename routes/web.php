<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('index');
});
Route::get('p/{id}', [PageController::class, 'index']);
Route::prefix('doctor')->group(function () {
    Route::get('/', function () {
        return view('pages.doctor');
    });
    Route::get('/{id}', function () {
        return view('pages.doctor.detail');
    });
    Route::get('/schedule/{id}', function () {
        return view('pages.doctor.schedule');
    });
});
Route::prefix('news')->group(function () {
    Route::get('/', function () {
        return view('pages.post');
    });
    Route::get('/{id}', [PostController::class, 'show']);
});
Route::prefix('article')->group(function () {
    Route::get('/', function () {
        return view('pages.post');
    });
    Route::get('/{id}', [PostController::class, 'show']);
});


require __DIR__.'/auth.php';

Route::middleware('guest')->get('/cms', function () {
    return 'not found ...';
});
Route::middleware('auth')->get('/cms', function () {
    return view('cms.index');
})->name('dashboard');
Route::prefix('cms')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard-clean');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('page')->group(function () {
        Route::get('/', [CMSController::class, 'pageIndex'])->name('cms.page');
        Route::get('/add', [CMSController::class, 'pageAdd']);
        Route::get('/{id}', [CMSController::class, 'pageEdit']);
    });
    Route::prefix('post')->group(function () {
        Route::get('/', [CMSController::class, 'postIndex'])->name('cms.post');
        Route::get('/add', [CMSController::class, 'postAdd']);
        Route::get('/{id}', [CMSController::class, 'postEdit']);
    });
    Route::prefix('resourceSummary')->group(function () {
        Route::get('/', [CMSController::class, 'resourceSummaryIndex'])->name('cms.resourceSummary');
        Route::get('/add', [CMSController::class, 'resourceSummaryAdd']);
        Route::get('/{id}', [CMSController::class, 'resourceSummaryEdit']);
    });
    Route::prefix('resourceDetail')->group(function () {
        Route::get('/', [CMSController::class, 'resourceDetailIndex'])->name('cms.resourceDetail');
        Route::get('/add', [CMSController::class, 'resourceDetailAdd']);
        Route::get('/{id}', [CMSController::class, 'resourceDetailEdit']);
    });
    Route::prefix('org')->group(function () {
        Route::get('/', [CMSController::class, 'orgIndex'])->name('cms.org');
        Route::get('/add', [CMSController::class, 'orgAdd']);
        Route::get('/{id}', [CMSController::class, 'orgEdit']);
    });
    Route::prefix('satisfaction')->group(function () {
        Route::get('/', [CMSController::class, 'satisfactionIndex'])->name('cms.satisfaction');
    });
    Route::prefix('web')->group(function () {
        Route::get('/', [CMSController::class, 'webInfoIndex'])->name('cms.web-info');
        Route::get('/add', [CMSController::class, 'webInfoAdd']);
        Route::get('/{id}', [CMSController::class, 'webInfoEdit']);
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [CMSController::class, 'userIndex'])->name('cms.user');
        Route::get('/add', [CMSController::class, 'userAdd']);
        Route::get('/{id}', [CMSController::class, 'userEdit']);
    });
});