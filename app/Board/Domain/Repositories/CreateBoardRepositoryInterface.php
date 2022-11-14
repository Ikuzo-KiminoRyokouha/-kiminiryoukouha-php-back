<?php
namespace App\Board\Domain\Repositories;


interface CreateBoardRepositoryInterface{
    public function create($data): bool;
}