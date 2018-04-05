<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    require_once($var);

    $events_searcher = new EventModel();
    $events = $events_searcher->getAll();
    echo $events;
?>
