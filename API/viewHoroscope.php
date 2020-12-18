<?php

try {

    session_start();

    if(isset($_SERVER["REQUEST_METHOD"])) {

        if($_SERVER["REQUEST_METHOD"] === "GET") {
            
           if(isset($_SESSION["horoscope"])) {

                echo json_encode(unserialize($_SESSION["horoscope"]));
                exit;
            } else {
                
                echo json_encode("Inget horoskop är sparat..");  
                exit;
            } 
        } else {
            throw new Exception("Inte en giltlig förfrågan", 405); 
        }
    }

} catch(Exception $error) {
    echo json_encode(
        array(
            "Message" => $error -> getMessage(), 
            "Status" => $error -> getCode()
        )
    );
    exit;
}

?>
