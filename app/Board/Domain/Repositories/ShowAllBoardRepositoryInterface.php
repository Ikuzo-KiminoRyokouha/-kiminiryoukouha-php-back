<?php
namespace App\Board\Domain\Repositories;

interface ShowAllBoardRepositoryInterface{
    public function show($page):array;
}