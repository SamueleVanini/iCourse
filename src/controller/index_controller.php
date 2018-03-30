<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_search_model.php";
require_once($var);

$events_searcher = new EventsSearcher();
$events = $events_searcher->getAll();
echo $events;
?>