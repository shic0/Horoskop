<?php

function calculateHoroscope($day, $month) {
    $calculateHoroscope = "";

        if     (($month == 3 && $day > 20) || ($month == 4 && $day < 20)) { $calculateHoroscope = "Väduren";}
        elseif (($month == 4 && $day > 19) || ($month == 5 && $day < 21)) { $calculateHoroscope = "Oxen";}
        elseif (($month == 5 && $day > 20) || ($month == 6 && $day < 21)) { $calculateHoroscope = "Tvillingarna";}
        elseif (($month == 6 && $day > 20) || ($month == 7 && $day < 23)) { $calculateHoroscope = "Kräftan";}
        elseif (($month == 7 && $day > 22) || ($month == 8 && $day < 23)) { $calculateHoroscope = "Lejonet";}
        elseif (($month == 8 && $day > 22) || ($month == 9 && $day < 23)) { $calculateHoroscope = "Jungfrun";}
        elseif (($month == 9 && $day > 22) || ($month == 10 && $day < 23)) { $calculateHoroscope = "Vågen";}
        elseif (($month == 10 && $day > 22) || ($month == 11 && $day < 22)) { $calculateHoroscope = "Skorpionen";}
        elseif (($month == 11 && $day > 21) || ($month == 12 && $day < 22)) { $calculateHoroscope = "Skytten";}
        elseif (($month == 12 && $day > 21) || ($month == 1 && $day < 20)) { $calculateHoroscope = "Stenbocken";}
        elseif (($month == 1 && $day > 19) || ($month == 2 && $day < 19)) { $calculateHoroscope = "Vattumannen";}
        elseif (($month == 2 && $day > 18) || ($month == 3 && $day < 21)) { $calculateHoroscope = "Fiskarna";}

        return $calculateHoroscope;
}


try {
    session_start();

    if(isset($_SERVER["REQUEST_METHOD"])) {

        if($_SERVER["REQUEST_METHOD"] === "POST") { 
            
            if(!isset($_SESSION["horoscope"])) { 

                echo json_encode(false);
                exit;
            }

            if(isset($_POST["day"]) && isset($_POST["month"])) {
               
                $yourHoroscope = calculateHoroscope($_POST["day"], $_POST["month"]); 
            
                $_SESSION["horoscope"] = serialize($yourHoroscope);

                echo json_encode(true);
                exit; 
                
             } else {
                throw new Exception("Inget datum är valt i body", 500); 
            }
             
        } else {
            throw new Exception("Ingen giltlig förfrågan", 405); 
        }
    }

} catch (Exception $error) {
    echo json_encode(
        array(  
            "Message" => $error -> getMessage(), 
            "Status" => $error -> getCode()
        )
    ); 
    exit;
}
?>