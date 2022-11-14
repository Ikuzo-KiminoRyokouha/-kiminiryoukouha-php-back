<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/auth')->group(function(){
    Route::post('/register', App\User\Actions\CreateUserAction::class)->name('auth.register');
    Route::post('/login',App\User\Actions\LoginAction::class)->name('auth.login');
    Route::get('/logout',App\User\Actions\LogoutAction::class)->name('auth.logout');
    Route::post('/check/user', App\User\Actions\CheckDuplicateEmailAction::class)->name('auth.check');
});

Route::prefix('/board')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::post('/', App\Board\Actions\CreateBoardAction::class)->name('board.create');
        Route::put('/{id}',App\Board\Actions\UpdateBoardAction::class)->name('board.update');
        Route::delete('/{id}',App\Board\Actions\DeleteBoardAction::class)->name('board.delete');
        Route::put('/restore/{id}',App\Board\Actions\RestoreBoardAction::class)->name('board.delete');
        Route::get('/my/deleted/{page}',App\Board\Actions\ShowDeletedBoardAction::class)->name('delted.board.show');
    });
    Route::get('/all/{page}',App\Board\Actions\ShowBoardAllAction::class)->name('boards.show');
    Route::get('/{id}',App\Board\Actions\ShowBoardAction::class)->name('board.show');
    Route::get('/search/{searchItem}/{page}',App\Board\Actions\ShowSearchedBoardAction::class)->name('board.search');

});

Route::prefix('/comment')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::post('/', App\Comment\Actions\CreateCommentAction::class)->name('comment.create');
        Route::put('/{id}', App\Comment\Actions\UpdateCommentAction::class)->name('comment.update');
        Route::delete('/{id}',App\Comment\Actions\DeleteCommentAction::class)->name('comment.delete');
        Route::put('/restore/{id}',App\Comment\Actions\RestorecommentAction::class)->name('comment.delete');
        Route::get('/my/deleted/{page}',App\Comment\Actions\ShowDeletedCommentAction::class)->name('delted.comment.show');
    });
    Route::get('/{board_id}/{page}', App\Comment\Actions\ShowCommentsAction::class)->name('comment.show');
});

Route::prefix('/user')->group(function(){
    Route::get('/',App\User\Actions\MyinfoAction::class)->name('user.myinfo');
});


