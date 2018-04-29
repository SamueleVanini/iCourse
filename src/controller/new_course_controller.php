<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var1);
    require_once($var2);


    if(isset($_POST["nomeEvento"]) && isset($_POST["dataInizioEvento"]) && isset($_POST["oraInizioEvento"]) && isset($_POST["dataFineEvento"]) && isset($_POST["oraFineEvento"]))
    {
        $events_searcher = new EventModel();
        $user = unserialize($_SESSION["user"]);
        $scartoFineEvento = date_diff($_POST["dataFineEvento"], $_POST["dataInizioEvento"]);
        $events = $events_searcher->insertEvent($user, $_POST["nomeEvento"], $_POST["descr"], $_POST["dataInizioEvento"], $scartoFineEvento, $_POST["luogo"], 
                                                $_POST["oraInizioEvento"], $_POST["oraFineEvento"], $_POST["ripetizione"], $_POST["fineRipetizione"]);
        echo $events;
    }
    else
    {
        echo false;
    }
?>
