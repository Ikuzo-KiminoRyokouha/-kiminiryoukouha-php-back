<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BoardController;
use App\Http\Controllers\api\CommentController;


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

Route::prefix('/user')->group(function(){
    Route::post('/register', [AuthController::class , 'register'])->name('user.register');
    Route::post('/login',[AuthController::class , 'login'])->name('user.login');
    Route::get('/logout',[AuthController::class , 'logout'])->name('user.logout');
    // Route::get('show',[UserController::class , 'show'])->name('user.show');
});

Route::prefix('/board')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::post('/',[BoardController::class, 'create'])->name('board.create');
        Route::put('/{id}',[BoardController::class , 'update'])->name('board.update');
        Route::delete('/{id}',[BoardController::class, 'delete'])->name('board.delete');
    });
    Route::get('/all/{page}',[BoardController::class, 'showAll'])->name('boards.show');
    Route::get('/{id}',[BoardController::class, 'show'])->name('board.show');
});

Route::prefix('/comment')->group(function(){
    Route::post('/', [CommentController::class,'create'])->name('comment.create');
    Route::get('/', [CommentController::class,'show'])->name('comment.show');
});




