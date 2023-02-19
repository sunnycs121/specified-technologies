<?php

use App\Http\Controllers\Api\TaskListsController;
use App\Http\Controllers\Api\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::prefix('tasklists')
    ->name('tasklists')
    ->group(function() {
        Route::get('/', [TaskListsController::class, 'index'])->name('index');
        Route::post('/', [TaskListsController::class, 'store'])->name('store');
        Route::get('/{tasklist}', [TaskListsController::class, 'show'])->name('show');
        Route::put('/{tasklist}', [TaskListsController::class, 'update'])->name('update');
        Route::delete('/{tasklist}', [TaskListsController::class, 'delete'])->name('delete');
    }); */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
