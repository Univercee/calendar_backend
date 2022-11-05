<?php

namespace App\Models;

use App\Helpers\Tools;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'telegram_id',
        'first_name',
        'username',
        'photo_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public static function find($telegram_id)
    {
        $user = DB::table("users")->select("id")->where("telegram_id", $telegram_id)->first();
        return $user->id ?? null;
    }

    public static function findByToken($token)
    {
        $user = DB::table("auth_tokens")->select("id")->where("token", $token)->where('expires_at', '>', Carbon::now())->first();
        return $user->id ?? null;
    }

    public static function add($user_data)
    {
        $user_data_copy = $user_data;
        $user_data_copy["telegram_id"] = $user_data["id"];
        unset($user_data_copy["id"]);
        unset($user_data_copy["auth_date"]);
        $user = DB::table("users")->insertGetId($user_data_copy);
        return $user;
    }

    public static function login($user_id)
    {
        $token = Tools::createAuthToken();
        DB::table("auth_tokens")->insert(["user_id"=>$user_id, "token"=>$token]);
        return $token;
    }
}
