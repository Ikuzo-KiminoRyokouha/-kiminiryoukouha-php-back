<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Board\Domain\Repositories\CreateBoardRepository;
use App\Board\Domain\Repositories\CreateBoardRepositoryInterface;
use App\Board\Domain\Repositories\ShowAllBoardRepository;
use App\Board\Domain\Repositories\ShowAllBoardRepositoryInterface;
use App\Board\Domain\Repositories\ShowBoardRepository;
use App\Board\Domain\Repositories\ShowBoardRepositoryInterface;
use App\Board\Domain\Repositories\UpdateBoardRepository;
use App\Board\Domain\Repositories\UpdateBoardRepositoryInterface;
use App\Board\Domain\Repositories\CheckBoardUserRepository;
use App\Board\Domain\Repositories\CheckBoardUserRepositoryInterface;
use App\Board\Domain\Repositories\DeleteBoardRepository;
use App\Board\Domain\Repositories\DeleteBoardRepositoryInterface;
use App\Board\Domain\Repositories\ShowDeletedBoardRepository;
use App\Board\Domain\Repositories\ShowDeletedBoardRepositoryInterface;
use App\Board\Domain\Repositories\ShowSearchedBoardRepository;
use App\Board\Domain\Repositories\ShowSearchedBoardRepositoryInterface;
use App\Board\Domain\Repositories\RestoreBoardRepository;
use App\Board\Domain\Repositories\RestoreBoardRepositoryInterface;



class BoardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(CreateBoardRepositoryInterface::class , CreateBoardRepository::class);
        $this->app->bind(ShowBoardRepositoryInterface::class, ShowBoardRepository::class);
        $this->app->bind(ShowAllBoardRepositoryInterface::class , ShowAllBoardRepository::class);
        $this->app->bind(UpdateBoardRepositoryInterface::class , UpdateBoardRepository::class);
        $this->app->bind(CheckBoardUserRepositoryInterface::class , CheckBoardUserRepository::class);
        $this->app->bind(DeleteBoardRepositoryInterface::class , DeleteBoardRepository::class);
        $this->app->bind(ShowDeletedBoardRepositoryInterface::class , ShowDeletedBoardRepository::class);
        $this->app->bind(ShowSearchedBoardRepositoryInterface::class , ShowSearchedBoardRepository::class);
        $this->app->bind(RestoreBoardRepositoryInterface::class , RestoreBoardRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
