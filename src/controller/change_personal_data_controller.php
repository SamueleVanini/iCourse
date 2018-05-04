<?php

    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/personal_data_model.php";
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
        $dataChange = new PersonalDataModel();
        $user = unserialize($_SESSION["user"]);
        $result = $dataChange->changeUserData($user);
        echo $result;
        echo "<br>";
        header("Refresh: 5; url = /iCourse/template/personal_data.php");
        echo "Redirect in 5 secondi...";
    }
?>
