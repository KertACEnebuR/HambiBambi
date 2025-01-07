<?php

function generateRandomString ($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }    
    return $randomString;
}

function printParameter ($data = "", $method = "echo") {
    switch ($data) {
        case "print_r": {
            echo "<pre>";
            print_r($variable);
            echo "</pre>";
            break;
        }
        case "var_dump": {
            var_dump($variable);
        }
        case "print": {
            print($variable);
        }       
        default : {
            echo $variable;
            break;            
        }
    }
}

function checkUnallowedCharacters($string, $unallowedList) {
    foreach ($unallowedList as $listElement) {
        if(str_contains($string, $listElement)) {
            return false;
        }
    }
    return true;
}

function checkAllowedCharacters($string, $allowedList) {
    $i = 0;
    foreach ($allowedList as $listElement) {
        if(str_contains($string, $listElement)) {
            $i++;
        }
    }

    if($i > 0) {
        return true;
    }
    return false;
}

?>