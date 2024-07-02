<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CMSController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('index');
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
    Route::prefix('resource-summary')->group(function () {
        Route::get('/', function () {
            return view('cms.resource-summary.index');
        })->name('cms.resource-summary');
        Route::get('/add', function () {
            return view('cms.resource-summary.add');
        });
        Route::get('/{id}', function () {
            return view('cms.resource-summary.edit');
        });
    });
    Route::prefix('resource-detail')->group(function () {
        Route::get('/', function () {
            return view('cms.resource-detail.index');
        })->name('cms.resource-detail');
        Route::get('/add', function () {
            return view('cms.resource-detail.add');
        });
        Route::get('/{id}', function () {
            return view('cms.resource-detail.edit');
        });
    });
    Route::prefix('org')->group(function () {
        Route::get('/', [CMSController::class, 'orgIndex'])->name('cms.org');
        Route::get('/add', [CMSController::class, 'orgAdd']);
        Route::get('/{id}', [CMSController::class, 'orgEdit']);
    });
    Route::prefix('satisfaction')->group(function () {
        Route::get('/', function () {
            return view('cms.satisfaction.index');
        })->name('cms.satisfaction');
        Route::get('/add', function () {
            return view('cms.satisfaction.add');
        });
        Route::get('/{id}', function () {
            return view('cms.satisfaction.edit');
        });
    });
    Route::prefix('web')->group(function () {
        Route::get('/', function () {
            return view('cms.web-info.index');
        })->name('cms.web-info');
        Route::get('/add', function () {
            return view('cms.web-info.add');
        });
        Route::get('/{id}', function () {
            return view('cms.web-info.edit');
        });
    });
    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return view('cms.user.index');
        })->name('cms.user');
        Route::get('/add', function () {
            return view('cms.user.add');
        });
        Route::get('/{id}', function () {
            return view('cms.user.edit');
        });
    });
});