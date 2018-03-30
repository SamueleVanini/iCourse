<?php

$var2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
$var1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_search_model.php";
require_once($var1);
require_once($var2);

$events_searcher = new EventsSearcher();
$user = unserialize($_SESSION["user"]);
$events = $events_searcher->searchUserEvents($user);
echo $events;
?>