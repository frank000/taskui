<?php

namespace App\Http\Service;




class TokenService
{

    /**
     *
     */
    public function getToken($data)
    {
        if(!array_key_exists('type', $data))
            return false;

        if(!array_key_exists('id', $data))
            return false;

        if(!array_key_exists('created', $data))
            return false;

        $json = json_encode($data);
        return base64_encode($json);
    }

}
