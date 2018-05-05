<?php
    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/event_model.php";
    $path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
    
    require_once($path1);
    require_once($path2);
    require_once($path3);

    if(isset($_REQUEST["Matricola"]) && isset($_REQUEST["activityId"]))
    {
        if(!checkSession())
        {
            header("Refresh: 3; url = /iCourse/template", true, 301);
            echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
        }
        else
        {
            $events_searcher = new EventModel();
            $user = unserialize($_SESSION["user"]);
            if(!($user->hasPrivilege(2)))
            {
                header("Refresh: 3; url = /iCourse/template", true, 301);
                echo "Non hai i privilegi per effettuare questa operazione, redirect in 3 secondi...";
                exit;
            }
            else
            {
                $events = $events_searcher->addStudentToEvent($_POST["Matricola"], $_REQUEST["activityId"]);
                echo $events;
            }
        }
    }
    else
    {
        echo false;
    }
?>