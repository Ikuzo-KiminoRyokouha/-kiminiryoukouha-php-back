<?php
namespace App\Comment\Domain\Repositories;

interface RestoreCommentRepositoryInterface{
    public function restore($id):bool;
}