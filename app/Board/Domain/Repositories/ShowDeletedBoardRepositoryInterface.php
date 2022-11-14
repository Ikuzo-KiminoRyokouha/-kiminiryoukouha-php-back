<?php
namespace App\Board\Domain\Repositories;

interface ShowDeletedBoardRepositoryInterface{
    public function show($page):array;
}