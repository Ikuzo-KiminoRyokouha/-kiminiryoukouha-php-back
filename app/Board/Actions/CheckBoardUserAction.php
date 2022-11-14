<?php

namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\CheckBoardUserRepositoryInterface;

class CheckBoardUserAction extends Controller{
    protected $checkuser;

    public function __construct(
        CheckBoardUserRepositoryInterface $checkuser
    ){
        $this->checkuser = $checkuser;
    }

    public function __invoke($id){
        $check = $this->checkuser->check($id);
        return $check;
    }
}