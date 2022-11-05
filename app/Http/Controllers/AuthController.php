<?php

namespace App\Http\Controllers;

use App\Helpers\Tools;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authFlow(Request $request)
    {
        $user_data = $request->input("user");
        $hash = $user_data['hash'];
        unset($user_data['hash']);

        $user_id = User::find($user_data['id']);
        if(!$user_id){
            $user_id = self::registration($user_data);
        }
        if(Tools::checkHash($user_data, $hash)){
            $token = self::login($user_id);
            return response()->json($token);
        }
        else{
            return response()->json("Data not from Telegram", 403);
        }
    }

    //
    private function registration(Array $user_data)
    {
        return User::add($user_data);
    }

    //
    private function login($user_id)
    {
        return User::login($user_id);
    }
}
