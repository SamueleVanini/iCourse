<?php

    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/download_model.php";
    $path3 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";

    require_once($path1);
    require_once($path2);
    require_once($path3);

    if(!checkSession())
    {
        header("Refresh: 3; url = /iCourse/template", true, 301);
        echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
    }
    else
    {
        echo $_GET["type"];
        echo $_GET["id"];
        /*$downloadSearcher=new DownloadModel();
        if($_GET["type"]=="materiale")
            $downloadSearcher->downloadMateriale($_GET["id"]);
        else if($_GET["type"]=="allegato")
            $downloadSearcher->downloadAllegato($_GET["id"]);*/
    }
?>
