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

            if($user->profile_image !==null || !str_starts_with($user['profile_image'], 'http')){

                $user->profile_image=asset('storage/' . $user->profile_image);
            }

            return response()->json([
                    "data"=>$user,
                    // "userImage"=>$user,
                    "message"=>"user fetched successfully"

            ],200);


        }else{

            return response()->json([
                "message"=>"user not found"
            ],404);
        }


    }
}
