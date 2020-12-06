<?php


namespace App\Models\Traits;


use App\Http\Service\TokenService;

trait CryptId
{
    public function get(int $value, string $type) : string
    {
        return TokenService::getToken(
            array('type' => $type,
                'id' => $value,
                'created' => date('m/d/Y h:i:s a', time()))
        );
    }

    public function set($value)
    {
        if (TokenService::isValid($value))
            return TokenService::tokenizer($value)->id;

        return $value;
    }
}
