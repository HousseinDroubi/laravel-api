<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function sortString($string){
        try {  
            $string = str_split($string);
            $stringSorted=sort($string);
            $stringSorted=implode($string);
            $string_numbers="";
            $string_lower="";
            $string_upper="";
            for($i=0;$i<strlen($stringSorted);$i++){
                if(is_numeric($stringSorted[$i])){
                    $string_numbers=$string_numbers.$stringSorted[$i];
                }
            }
            for($i=0;$i<strlen($stringSorted);$i++){
                if(!ctype_upper($stringSorted[$i]) && !is_numeric($stringSorted[$i])){
                    $string_lower=$string_lower.$stringSorted[$i];
                }
            }
            for($i=0;$i<strlen($stringSorted);$i++){
                if(ctype_upper($stringSorted[$i]) && !is_numeric($stringSorted[$i])){
                    $string_upper=$string_upper.$stringSorted[$i];
                }
            }
            
        }
          
          //catch exception
        catch(Exception $e) {
            return "Please try to enter a valid string.";
        }
    }
}
