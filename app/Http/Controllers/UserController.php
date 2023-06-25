<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function getUserDetail($id){
        $user=User::where('id',$id)->first();
        if(!empty($user)){

            return response()->json([
                    "data"=>$user,
                    "message"=>"user fetched successfully"

            ],200);


        }else{

            return response()->json([
                "message"=>"user not found"
            ],404);
        }


    }
}
