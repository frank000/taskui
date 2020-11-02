<?php

namespace App\Http\Service;

use App\Models\Constant;
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

    /**
     * Create the string to de days field in the grid
     * @param $arrDays
     * @return string
     *
     */
    protected static function handleDays($arrDays)
    {
        $resultString = "";
        if(count($arrDays))
        {
            if(!empty($arrDays['all']) && $arrDays['all'] || !empty($arrDays['uteis']) && $arrDays['uteis'])
            {
                $resultString .= " - " . $arrDays['hor_inicio_man'] . " ás " . $arrDays['hor_fim_man'] . " e ";
                $resultString .= $arrDays['hor_inicio_tar'] . " ás " . $arrDays['hor_fim_tar'];

                $resultString .= (!empty($arrDays['all']) && $arrDays['all'] )? ' - Todos os dias' : ' - Dias uteis' ;
            }
            else
            {
                foreach ($arrDays as $key =>$day)
                {
                    $resultString .= " | " . Constant::COMPLETE_DAYS[$key];
                }
            }
        }
        return $resultString;
    }

}
