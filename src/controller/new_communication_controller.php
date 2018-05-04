<?php

    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    $path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
    
    require_once($path1);
    require_once($path2);
    require_once($path3);

    if(isset($_REQUEST["nomeComunicazione"]) && isset($_REQUEST["testoComunicazione"]))
    {
        if(!checkSession())
        {
            header("Refresh: 3; url = /iCourse/template", true, 301);
            echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
        }
        else
        {
            $communication_model = new CommunicationModel();
            $user = unserialize($_SESSION["user"]);
            $communications = $communication_model->insertCommunication($user, $_REQUEST["selezionaCorso"], $_REQUEST["nomeComunicazione"], $_REQUEST["testoComunicazione"]);
            echo $communications;
        }
    }
    else
    {
        echo false;
    }
?>
