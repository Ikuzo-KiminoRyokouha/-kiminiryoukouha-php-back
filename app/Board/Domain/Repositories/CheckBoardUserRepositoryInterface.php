<?php
namespace App\Board\Domain\Repositories;

interface CheckBoardUserRepositoryInterface{
    public function check($id):bool;
}