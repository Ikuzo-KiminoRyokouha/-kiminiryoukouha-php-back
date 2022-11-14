<?php
namespace App\Board\Domain\Repositories;

interface RestoreBoardRepositoryInterface{
    public function restore($id):bool;
}