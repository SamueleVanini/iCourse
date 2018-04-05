<?php
    $var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var1);
    require_once($var2);

    $passChange = new EventModel();
    $user = unserialize($_SESSION["user"]);
    $result = $passChange->changeUserPassword($user);
    echo $result;
    echo "<br><br>";
    header("Refresh: 3; url = /iCourse/template/personal_data.php");
    echo "Redirect in 3 secondi...";
?>
