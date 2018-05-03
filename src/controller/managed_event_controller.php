<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/communication_model.php";
    require_once($var1);
    require_once($var2);

    $managed_events_searcher = new CommunicationModel();
    $user = unserialize($_SESSION["user"]);
    $managed_events = $managed_events_searcher->getAllNomeEventiGestiti($user);
    echo $managed_events;
?>
