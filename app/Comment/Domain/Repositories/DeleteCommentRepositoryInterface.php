<?php
namespace App\Comment\Domain\Repositories;

interface DeleteCommentRepositoryInterface{
    public function delete($id):bool;
}