<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function getUserDetail($id){
        $user=User::where('id',$id)->first();
        $products=Item::where('user_id',$id)->get()->toArray();
        if(!empty($user)){

            if($user->profile_image !==null && !str_starts_with($user['profile_image'], 'http')){

                $user->profile_image=asset('storage/' . $user->profile_image);
            }

            $userProducts = array_map(function ($product) {
                  if (!str_starts_with($product['image'], 'http')) {
                $product['image'] = asset('storage/' . $product['image']);
               }

                return $product;
           }, $products);


            return response()->json([
                    "data"=>$user,
                    "userProduct"=>$userProducts,
                    "message"=>"user fetched successfully"

            ],200);


        }else{

            return response()->json([
                "message"=>"user not found"
            ],404);
        }


    }
}
