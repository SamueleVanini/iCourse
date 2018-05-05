<?php
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/user_model.php";
    require_once($var1);

    if(isset($_REQUEST["activityId"]))
    {
        $user_searcher = new UserSearcher();
        $users = $user_searcher->getAllUser($_REQUEST["activityId"]);
        echo $users;
    }
?>