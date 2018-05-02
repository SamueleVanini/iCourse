<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var1);
    require_once($var2);

    //print_r($_REQUEST);
    if(isset($_REQUEST["nomeEvento"]) && isset($_REQUEST["dataInizioEvento"]) && isset($_REQUEST["oraInizioEvento"]) && isset($_REQUEST["dataFineEvento"]) && isset($_REQUEST["oraFineEvento"]))
    {
        $events_searcher = new EventModel();
        $user = unserialize($_SESSION["user"]);
        $dataInizioEvento = new DateTime($_REQUEST["dataInizioEvento"]);
        $dataFineEvento = new DateTime($_REQUEST["dataFineEvento"]);

        $scartoFineEvento = date_diff($dataFineEvento, $dataInizioEvento);
        $events = $events_searcher->insertEvent($user, $_REQUEST["nomeEvento"], $_REQUEST["descr"], $dataInizioEvento, $scartoFineEvento, $_REQUEST["luogo"], 
                                                $_REQUEST["oraInizioEvento"], $_REQUEST["oraFineEvento"], $_REQUEST["ripetizione"], $_REQUEST["fineRipetizione"]);
        echo $events;
        //variabili per debug
        /*if($events)
            echo "true";
        else
            echo "false";
        */
    }
    else
    {
        echo false;
    }
?>
