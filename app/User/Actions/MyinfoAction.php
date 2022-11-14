<?php
namespace App\User\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User\Domain\Repositories\MyinfoRepositoryInterface;
use App\User\Responders\MyinfoResponder;

class MyinfoAction extends Controller{

    protected $myinfo;
    protected $myinfoResponder;

    public function __construct(
        MyinfoRepositoryInterface $myinfo,
        MyinfoResponder $myinfoResponder
    ){
        $this->myinfo = $myinfo;
        $this->myinfoResponder = $myinfoResponder;
    }

    public function __invoke(Request $request){
        $user = $this->myinfo->show();

        return $this->myinfoResponder->response($user);


    }

}