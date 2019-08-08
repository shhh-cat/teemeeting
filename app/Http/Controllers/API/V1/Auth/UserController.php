<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth;


class UserController extends Controller 
{

    public $successStatus = 200;
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function getSelf() 
    { 
        $user = Auth::user(); 
        return response()->json($user, $this->successStatus);
    }
}