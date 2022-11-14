<?php
namespace App\Comment\Domain\Repositories;

interface CreateCommentRepositoryInterface{
    public function create($data):bool;
}