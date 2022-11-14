<?php

namespace App\User\Domain\Repositories;

use Illuminate\Http\Request;


interface CheckDuplicateEmailRepositoryInterface{
    public function check( $data  ):bool;
}