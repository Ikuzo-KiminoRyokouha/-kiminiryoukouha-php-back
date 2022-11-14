<?php
namespace App\Comment\Domain\Repositories;

interface CheckCommentUserRepositoryInterface{
    public function check($id):bool;
}