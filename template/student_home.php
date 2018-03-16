<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/user_controller.php";
require_once($var);

$user = new UserControllerBase();

if(isset($_SESSION["user"]) && isset($_SESSION["logged"]) && $_SESSION["logged"]=true)
{
    
    if($_SESSION["user"]->hasPrivilege(1))
    {
        header("Refresh: 3; url = ./index.html", true, 301);
        echo "Non hai i privilegi per accedere a questa pagina, redirect in 3 secondi...";
    }
}
else
{
    header("Refresh: 3; url = ./index.html", true, 301);
    echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
}
?>