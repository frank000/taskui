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
    public static function tokenizer($token, $isArray = false)
    {
        if(!is_null($token))
        {
            $base = base64_decode($token);

            if(is_null(json_decode($base)))
                throw new \Exception("Parametro incorreto.");

            return json_decode($base,$isArray);
        }

    }

    public static function isValid($data)
    {
        if(!is_array( $data))
            return false;

        if(!array_key_exists('type', $data))
            return false;

        if(!array_key_exists('id', $data))
            return false;

        if(!array_key_exists('created', $data))
            return false;

        return true;
    }
    public static function equals($val1 , $val2)
    {
        if(!empty($val1) && !empty($val2))
        {
            return self::tokenizer($val1)->id == self::tokenizer($val2)->id;
        }
        return false;

    }

}
