<?php

namespace App\Funciones;

class FunctionCustom
{
    function flotante(string $string) : bool {
        return is_numeric($string) && strpos($string, '.') !== false;
    }

    public function decodificar_json($array){
        //$result = [];
        if(is_array($array)){
            foreach ($array as $key => $value) {
                $array[$key] = self::decodificar_json($value);
            }
            //$result = $array;
        }else{
            $result = json_decode($array);
            if ( ($result) && (!is_numeric($result)) ) {
                $array = self::decodificar_json(json_decode($array,true));
            }else{
                //Debugbar::info('$array');
                //Debugbar::info($array);
                if(is_numeric($array)) {
                    //Debugbar::info('NUMERIC');
                    $array = (self::flotante($array)) ? floatval(preg_replace('/,/','',$array)) : intval($array) ;
                }else if( ($array==='true') || ($array==='false') ){
                    //Debugbar::info('ELSE');
                    $array = boolval($array) ;
                }
                return $array;
            }
        }
        return $array;
    }

    public function objectToArray($value){
        $result = [];
        if(is_array($value)){
            foreach ($value as $key => $val) {
                $result = [...$result,strtoupper($key).': '.implode(". ",$val)];
            }
            //$result = $value;
        }else{
            $result = [...$result,'Error'];
        }
        return $result;
    }
}
