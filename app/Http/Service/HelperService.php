<?php

namespace App\Http\Service;

use File;

class HelperService
{
    public static function imagenToBase64($rota)
    {
        $path = $rota;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = File::get($path);

        $base64 = "";
        if ($type == "svg") {
            $base64 = "data:image/svg+xml;base64,".base64_encode($data);
        } else {
            $base64 = "data:image/". $type .";base64,".base64_encode($data);
        }
        return $base64;
    }

    /**
     * Function that groups an array of associative arrays by some key.
     *
     * @param {String} $key Property to sort by.
     * @param {Array} $data Array that stores multiple associative arrays.
     */
    public static function group_by($key, $data) {
        $result = array();

        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }

        return $result;
    }

}
