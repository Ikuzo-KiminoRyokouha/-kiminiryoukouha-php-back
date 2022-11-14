<?php

namespace App\User\Domain\Repositories;

interface CreateUserRepositoryInterface{
    public function create( $data ):bool;
}