<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\OrgController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\ResourceDetailController;
use App\Http\Controllers\API\ResourceSummaryController;
use App\Http\Controllers\API\SatisfactionController;

Route::prefix('user')->group(function () {
    Route::get('/users', function () { return $request->user(); });
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});
Route::resource('user', AuthController::class, ['only' => ['index', 'show']]);
Route::post('/user/{id}', [AuthController::class, 'update'])->middleware(['auth:api']);
Route::resource('user', AuthController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('post', PostController::class, ['only' => ['index', 'show']]);
Route::post('/post/{id}', [PostController::class, 'update'])->middleware(['auth:api']);
Route::resource('post', PostController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('option', OptionController::class, ['only' => ['index', 'show']]);
Route::post('/option/{id}', [OptionController::class, 'update'])->middleware(['auth:api']);
Route::resource('option', OptionController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('org', OrgController::class, ['only' => ['index', 'show']]);
Route::post('/org/{id}', [OrgController::class, 'update'])->middleware(['auth:api']);
Route::resource('org', OrgController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('page', PageController::class, ['only' => ['index', 'show']]);
Route::post('/page/{id}', [PageController::class, 'update'])->middleware(['auth:api']);
Route::resource('page', PageController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('resourceDetail', ResourceDetailController::class, ['only' => ['index', 'show']]);
Route::post('/resourceDetail/schedule', [ResourceDetailController::class, 'updateSchedule'])->middleware(['auth:api']);
Route::post('/resourceDetail/{id}', [ResourceDetailController::class, 'update'])->middleware(['auth:api']);
Route::resource('resourceDetail', ResourceDetailController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('resourceSummary', ResourceSummaryController::class, ['only' => ['index', 'show']]);
Route::post('/resourceSummary/{id}', [ResourceSummaryController::class, 'update'])->middleware(['auth:api']);
Route::resource('resourceSummary', ResourceSummaryController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);

Route::resource('satisfaction', SatisfactionController::class, ['only' => ['index', 'show']]);
Route::post('/satisfaction/{id}', [SatisfactionController::class, 'update'])->middleware(['auth:api']);
Route::resource('satisfaction', SatisfactionController::class, ['except' => ['index', 'show']])->middleware(['auth:api']);
