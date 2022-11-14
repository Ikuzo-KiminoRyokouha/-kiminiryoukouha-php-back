<?php
namespace App\Board\Domain\Repositories;

interface DeleteBoardRepositoryInterface{
    public function delete($id):bool;
}