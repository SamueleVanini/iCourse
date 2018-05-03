<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var1);
    require_once($var2);

    $dataView = new EventModel();
    $user = unserialize($_SESSION["user"]);
    $result = $dataView->viewUserData($user);
    echo $result;
?>
