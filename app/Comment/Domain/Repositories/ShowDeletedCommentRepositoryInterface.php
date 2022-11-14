<?php
namespace App\Comment\Domain\Repositories;

interface ShowDeletedCommentRepositoryInterface{
    public function show($page):array;
}