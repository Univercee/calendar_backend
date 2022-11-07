<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'title',
        'description',
        'is_notified'
    ];


    //
    public static function get(int $user_id)
    {
        $response = DB::table("events")->select()->where("user_id", "=", $user_id)->get();
        return $response;
    }

    //
    public static function add(Array $event, int $user_id)
    {
        $event["user_id"] = $user_id;
        return DB::table("events")->insertGetId($event);
    }

    //
    public static function edit(Array $event, int $user_id)
    {
        $id = $event["id"];
        unset($event["id"]);
        return DB::table("events")->where("user_id", "=", $user_id)->where("id", "=", $id)->update($event);
    }

    //
    public static function remove(Array $event, int $user_id)
    {
        return DB::table("events")->where("user_id", "=", $user_id)->delete($event);
    }
}
