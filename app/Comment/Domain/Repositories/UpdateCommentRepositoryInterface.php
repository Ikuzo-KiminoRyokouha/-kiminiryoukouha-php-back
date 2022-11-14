<?php
namespace App\Comment\Domain\Repositories;

interface UpdateCommentRepositoryInterface{
    public function update($request ,$id):bool;
}