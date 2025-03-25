<?php
    $data = json_decode(file_get_contents("php://input"), true); // json string


    function checkEmpty($data = []) {
        $message = "";
        foreach($data as $key => $element) {
            if(strlen($element) == 0 ) {
                $message .= "<p>A {$key} mező kitöltése kötelező!</p>";
            }
        }

        return $message;
    }

    /*
    function escapeData($data = []) {
        $escapedData = [];
        foreach($data as $key => $element) {
                $escapedData[] = mysqli_real_escape_string($element);
        }

        return $escapedData;
    }
    */
    
    function sanitizeFormData($data = []) {
        $message = checkEmpty($data);
        $finalData = [];
        /*if($message == "") {
            $finalData = escapeData($data);            

        }*/
        return ["message" => $message, "data" => $finalData];
    }

    if(isset($data["c"])) {   
        if($data["c"] == "login") {
            $finalData = sanitizeFormData($data);            
            echo json_encode($finalData, true);
        }        
    }
?>