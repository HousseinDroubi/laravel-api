<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    function sortString($string){
        try {  
            // The below three functions will get the string and sort it into numbers, upper than lower letters
            $string = str_split($string);
            $sorted=sort($string);
            $sorted=implode($string);
            $numbers="";
            $lower="";
            $upper="";
            // Get numbers
            for($i=0;$i<strlen($sorted);$i++){
                if(is_numeric($sorted[$i])){
                    $numbers=$numbers.$sorted[$i];
                }
            }
            // Get lower letters
            for($i=0;$i<strlen($sorted);$i++){
                if(!ctype_upper($sorted[$i]) && !is_numeric($sorted[$i])){
                    $lower=$lower.$sorted[$i];
                }
            }
            // Get upper letters
            for($i=0;$i<strlen($sorted);$i++){
                if(ctype_upper($sorted[$i]) && !is_numeric($sorted[$i])){
                    $upper=$upper.$sorted[$i];
                }
            }
             // merge upper and lower letters
            $merge_upper_lower=$lower.$upper;
            $arrange_string="";
            // Check each lower letter and catch if there's same letter without case sensitie in upper letter.
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
            // Add the numbers to last
            $arrange_string=$arrange_string.$numbers;
            // Return result
            return $arrange_string;
        }
          
        catch(Exception $e) {
            return "Please try to enter a valid string.";
        }
    }
  
    function arrangeNumber($num){
        // Define all parameters
        $multipliyer = 1;
        $sign = 1;
        $lenght = 0;
        $n=$num;
        $result = array();
        $res = array();

        // In the below block we are converting the number to its positive value but the sign will be minus.
        if($num < 0){
            $num = $num * -1;
            $sign = -1;
        }
        // In the below block we are getting how many digit the number could be.
        while (intval($n) > 0) {
            $n = intval($n) / 10;
            $lenght += 1;
        }
        // Here, we are dividing each number and put it into an array 
        while( $lenght > 0){
            array_push($result,(int)$num%10);
            $num = $num / 10;
            $lenght--;
        }
        // Hrere, we are converting each number by its position as its place value.
        for($i = 0 ; $i < count($result) ; $i++){
            array_push($res,$sign*$result[$i]*$multipliyer);
            $multipliyer = $multipliyer * 10;
        }
        // The result will be reversed, so we have to reverse it back.
        $res = array_reverse($res);
        // Return the result.
        return json_encode($res);
    }

    function getBinaryFromString($string){
        // Initiate binary array in order to fill it with binary of numbers given by the string.
        $binary = array();
        // The below method will get the numbers from string and put them into matches which is an array.
        preg_match_all('!\d+!', $string, $matches);
        // count() will return the length of the array
        $lengh = count($matches[0]);
        // In the below block, we are filling binary array with the binary form of numbers
        for($i = 0 ; $i < $lengh ; $i++){
            array_push($binary,decbin($matches[0][$i]));
        }
        // $result will contain the initial string but the numbers will be converted to binary form.
        $result = str_replace($matches[0], $binary, $string);
        
        return $result;
    }

    function getResultFromPrefix($string){
        // In the below array we array splitting the given string according to the space and put them
        // into an array.
        $prefix = explode(" ", $string);
        // The result will be return at the end of the funtion.
        $result = "";
        // $notation is the notation and it will be at first index.
        $notation = $prefix[0];
        // $first_number will be at the second index.
        $first_number=$prefix[1];
        // $second_number will be at the third index.
        $second_number=$prefix[2];

        // In the below block funtion and instead of using if else, we can use switch and retreive the
        // result.
        switch ($notation) {
            case "+":
                $result=$first_number+$second_number;
            break;
            case "-":
                $result=$first_number-$second_number;
            break;
            case "*":
                $result=$first_number*$second_number;
            break;
            case "/":
                $result=$first_number/$second_number;
                break;
        }
        // Retrun the result
        return $result;
        }
}
