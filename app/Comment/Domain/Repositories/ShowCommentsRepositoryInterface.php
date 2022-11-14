<?php
namespace App\Comment\Domain\Repositories;

interface ShowCommentsRepositoryInterface{
    public function show($board_id, $page):array;
}