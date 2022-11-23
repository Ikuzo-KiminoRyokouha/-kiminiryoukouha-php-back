<?php
namespace App\Board\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Board\Domain\Repositories\CreateBoardRepositoryInterface;
use App\Common\Responders\RequestResponder;
use App\Common\Responders\RequestValidResponder;




class CreateBoardAction extends Controller{

    protected $createBaord;
    protected $requestResponder;
    protected $validResponder;

    public function __construct(       
         CreateBoardRepositoryInterface $createBaord,
         RequestResponder $requestResponder,
         RequestValidResponder $validResponder
    ){
        $this->createBaord = $createBaord;
        $this->requestResponder = $requestResponder;
        $this->validResponder = $validResponder;
    }

    public function __invoke(Request $request){
        $valid = validator($request->only('title' , 'content' ,'private' ),[
            'title' =>'required|string|max:255',
            'content'=> 'required|string',
            'private' => 'required',
        ]);
        
        if($valid->fails()){
            return $this->validResponder->response($valid);
        }

        $data = request()->only('title', 'content' , 'private' );

        $check = $this->createBaord->create($data);

        return $this->requestResponder->response($check,"create" , "board");

    }

}
