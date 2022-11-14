<?php

namespace App\Comment\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Comment\Domain\Repositories\CheckCommentUserRepositoryInterface;

class CheckCommentUserAction extends Controller{
    protected $checkuser;

    public function __construct(
        CheckCommentUserRepositoryInterface $checkuser
    ){
        $this->checkuser = $checkuser;
    }

    public function __invoke($id){
        $check = $this->checkuser->check($id);
        return $check;
    }
}