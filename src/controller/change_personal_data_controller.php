<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var1);
    require_once($var2);

    $dataChange = new EventModel();
    $user = unserialize($_SESSION["user"]);
    $result = $dataChange->changeUserData($user);
    echo $result;
    echo "<br>";
    header("Refresh: 5; url = /iCourse/template/personal_data.php");
    echo "Redirect in 5 secondi...";
?>
