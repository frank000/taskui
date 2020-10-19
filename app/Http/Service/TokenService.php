<?php

namespace App\Http\Service;




class TokenService
{

    /**
     *
     */
    public static function getToken($data)
    {
        self::isValid($data);

        $json = json_encode($data);
        return base64_encode($json);
    }

    /**
     *
     */
    public static function tokenizer($token)
    {
        $base = base64_decode($token);

        if(is_null(json_decode($base)))
            throw new \Exception("Parametro incorreto.");

        return json_decode($base);
    }

    public static function isValid($data)
    {
        if(!array_key_exists('type', $data))
            return false;

        if(!array_key_exists('id', $data))
            return false;

        if(!array_key_exists('created', $data))
            return false;

        return true;
    }

}
