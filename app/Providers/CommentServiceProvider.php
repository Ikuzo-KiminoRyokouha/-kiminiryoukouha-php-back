<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Comment\Domain\Repositories\CreateCommentRepository;
use App\Comment\Domain\Repositories\CreateCommentRepositoryInterface;
use App\Comment\Domain\Repositories\ShowCommentsRepository;
use App\Comment\Domain\Repositories\ShowCommentsRepositoryInterface;
use App\Comment\Domain\Repositories\UpdateCommentRepository;
use App\Comment\Domain\Repositories\UpdateCommentRepositoryInterface;
use App\Comment\Domain\Repositories\CheckCommentUserRepository;
use App\Comment\Domain\Repositories\CheckCommentUserRepositoryInterface;
use App\Comment\Domain\Repositories\DeleteCommentRepository;
use App\Comment\Domain\Repositories\DeleteCommentRepositoryInterface;
use App\Comment\Domain\Repositories\ShowDeletedCommentRepository;
use App\Comment\Domain\Repositories\ShowDeletedCommentRepositoryInterface;
use App\Comment\Domain\Repositories\RestoreCommentRepository;
use App\Comment\Domain\Repositories\RestoreCommentRepositoryInterface;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(CreateCommentRepositoryInterface::class , CreateCommentRepository::class);
        $this->app->bind(ShowCommentsRepositoryInterface::class , ShowCommentsRepository::class);
        $this->app->bind(UpdateCommentRepositoryInterface::class , UpdateCommentRepository::class);
        $this->app->bind(CheckCommentUserRepositoryInterface::class , CheckCommentUserRepository::class);
        $this->app->bind(DeleteCommentRepositoryInterface::class , DeleteCommentRepository::class);
        $this->app->bind(ShowDeletedCommentRepositoryInterface::class , ShowDeletedCommentRepository::class);
        $this->app->bind(RestoreCommentRepositoryInterface::class , RestoreCommentRepository::class);

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
