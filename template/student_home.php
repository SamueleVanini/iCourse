<?php

if(!(isset($_SESSION["user"]) && isset($_SESSION["logged"]) && $_SESSION["logged"]=true))
{
    header("Refresh: 3; url = ./index.html", true, 301);
    echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
}
?>