<?php

namespace App\Board\Domain\Repositories;

interface ShowBoardRepositoryInterface{
    public function show($board_id): object;
}