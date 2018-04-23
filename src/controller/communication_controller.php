<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    require_once($var1);
    require_once($var2);

    $communications_searcher = new communicationModel();
    $user = unserialize($_SESSION["user"]);
    $communications = $communications_searcher->getUserCommunications($user);
    echo $communications;
?>
