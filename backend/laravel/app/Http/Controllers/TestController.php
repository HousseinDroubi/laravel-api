<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    function sortString($string){
        try {  
            $string = str_split($string);
            $sorted=sort($string);
            $sorted=implode($string);
            $numbers="";
            $lower="";
            $upper="";
            for($i=0;$i<strlen($sorted);$i++){
                if(is_numeric($sorted[$i])){
                    $numbers=$numbers.$sorted[$i];
                }
            }
            for($i=0;$i<strlen($sorted);$i++){
                if(!ctype_upper($sorted[$i]) && !is_numeric($sorted[$i])){
                    $lower=$lower.$sorted[$i];
                }
            }
            for($i=0;$i<strlen($sorted);$i++){
                if(ctype_upper($sorted[$i]) && !is_numeric($sorted[$i])){
                    $upper=$upper.$sorted[$i];
                }
            }
            $merge_upper_lower=$lower.$upper;
            $arrange_string="";
            for($i=0;$i<strlen($merge_upper_lower);$i++){ 
                if(ctype_upper($merge_upper_lower[$i])){
                    break;
                }
                $lower_character=$merge_upper_lower[$i];

                for($j=0;$j<strlen($upper);$j++){
                    if(strcasecmp($lower_character, $upper[$j])==0){
                        $lower_character=$lower_character.$upper[$j];
                    }
                }
                $arrange_string=$arrange_string.$lower_character;
            }
            $arrange_string=$arrange_string.$numbers;
            return $arrange_string;
        }
          
        catch(Exception $e) {
            return "Please try to enter a valid string.";
        }
    }
  
    function arrangeNumber($number){
        $multipliyer = 1;
        $sign = 1;
        $lenght = 0;
        $n=$number;
        
        $result = array();
        $res = array();

        if($number < 0){
            $number = $number * -1;
            $sign = -1;
        }

        while (intval($n) > 0) {
            $n = intval($n) / 10;
            $lenght += 1;
        }
        while( $lenght > 0){
            array_push($result,(int)$number%10);
            $number = $number / 10;
            $lenght--;
        }

        for($i = 0 ; $i < count($result) ; $i++){
            array_push($res,$sign*$result[$i]*$multipliyer);
            $multipliyer = $multipliyer * 10;
        }

        $res = array_reverse($res);
        return json_encode($res);
    }
}
