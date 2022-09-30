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
            for($i=0;$i<strlen($stringSorted);$i++){
                if(is_numeric($stringSorted[$i])){
                    $string_numbers=$string_numbers.$stringSorted[$i];
                }
            }
            return $string_numbers;
        }
          
          //catch exception
        catch(Exception $e) {
            return "Please try to enter a valid string.";
        }
    }
}
