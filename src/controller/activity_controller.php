<?php
    $var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/activity_model.php";
    require_once($var1);

    $activity_id=$_GET["activity_id"];
    $activity_searcher = new activityModel();
    $activity = $activity_searcher->getActivityAllInformation($activity_id);
    echo $activity;
?>
