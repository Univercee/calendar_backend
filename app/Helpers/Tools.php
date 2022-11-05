<?php

namespace App\Helpers;

class Tools
{
    //
    public static function createAuthToken()
    {
        return bin2hex(random_bytes(64));
    }

    //
    public static function checkHash($user_data, $check_hash){
        $isValid = false;
        $hash = self::getAuthHash($user_data);
        if (strcmp($hash, $check_hash) === 0) {
            $isValid = true;
        }
        return $isValid;
      }
    
    //
    private static function getAuthHash($user_data) {
        $data_check_arr = [];
        foreach ($user_data as $key => $value) {
          $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash('sha256', env('TELEGRAM_BOT_TOKEN'), true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        return $hash;
      }
}
