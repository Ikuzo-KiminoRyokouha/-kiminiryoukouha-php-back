<?php
namespace App\Board\Domain\Repositories;

interface ShowSearchedBoardRepositoryInterface{
    public function show($serachedItem ,$page);
}