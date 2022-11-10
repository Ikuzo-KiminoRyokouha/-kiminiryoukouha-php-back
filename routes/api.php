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

Route::prefix('/auth')->group(function(){
    Route::post('/register', [AuthController::class , 'register'])->name('auth.register');
    Route::post('/login',[AuthController::class , 'login'])->name('auth.login');
    Route::get('/logout',[AuthController::class , 'logout'])->name('auth.logout');
    Route::post('/check/user', [AuthController::class , 'checkDuplicateEmail'])->name('auth.check');
});

Route::prefix('/board')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::post('/',[BoardController::class, 'create'])->name('board.create');
        Route::put('/{id}',[BoardController::class , 'update'])->name('board.update');
        Route::delete('/{id}',[BoardController::class, 'delete'])->name('board.delete');
        Route::get('/my/deleted/{page}',[BoardController::class, 'deletedBoard'])->name('delted.board.show');
    });
    Route::get('/all/{page}',[BoardController::class, 'showAll'])->name('boards.show');
    Route::get('/pages',[BoardController::class, 'allPage'])->name('board.page');
    Route::get('/{id}',[BoardController::class, 'show'])->name('board.show');
    Route::get('/search/{searchItem}/{page}',[BoardController::class,'searchData'])->name('board.search');

});

Route::prefix('/comment')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::post('/', [CommentController::class,'create'])->name('comment.create');
        Route::put('/{id}', [CommentController::class,'update'])->name('comment.update');
        Route::delete('/{id}',[CommentController::class,'delete'])->name('comment.delete');
        Route::get('/my/deleted/{page}',[CommentController::class, 'deletedComment'])->name('delted.comment.show');
    });
    Route::get('/{board_id}/{page}', [CommentController::class,'show'])->name('comment.show');
});

Route::prefix('/user')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::get('/myinfo',[UserController::class, 'myInfo'])->name('user.info');
    });
});



