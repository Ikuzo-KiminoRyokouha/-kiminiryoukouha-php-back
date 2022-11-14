<?php
namespace App\Board\Domain\Repositories;

interface UpdateBoardRepositoryInterface{
    public function update($request ,$id):bool;
}