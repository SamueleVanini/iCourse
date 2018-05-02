<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    require_once($var1);
    require_once($var2);

    if(isset($_REQUEST["nomeComunicazione"]) && isset($_REQUEST["testoComunicazione"]))
    {
        $communication_model = new communicationModel();
        $user = unserialize($_SESSION["user"]);
        $communications = $communication_model->insertCommunication($user, $_REQUEST["selezionaCorso"], $_REQUEST["nomeComunicazione"], $_REQUEST["testoComunicazione"]);
        echo $communications;
    }
    else
    {
        echo false;
    }
?>
