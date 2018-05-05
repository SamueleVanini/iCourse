<?php

    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    $path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";

    require_once($path1);
    require_once($path2);
    require_once($path3);

    if(!checkSession())
    {
        header("Refresh: 3; url = /iCourse/template", true, 301);
        echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
    }
    else
    {
        $communications_searcher = new CommunicationModel();
        $user = unserialize($_SESSION["user"]);
        if(isset($_GET["communication_id"])){
            $communication = $communications_searcher->getCommunication($user,$_GET["communication_id"]);
            echo $communication;
        } else {
            $communications = $communications_searcher->getUserCommunications($user);
            echo $communications;
        }
    }
?>
