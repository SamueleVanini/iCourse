<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    require_once($var1);
    require_once($var2);


    if(isset($_POST["nomeComunicazione"]) && isset($_POST["testoComunicazione"]))
    {
        $communication_model = new communicationModel();
        $user = unserialize($_SESSION["user"]);
        $result = salvaComunicazione($_POST["idEv"], $_POST["nomeComunicazione"], $_POST["testoComunicazione"], $_POST["file"], $_POST["nomeFile"]);
    }
    else
    {
        echo false;
    }
?>
