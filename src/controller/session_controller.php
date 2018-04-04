<?php
    session_start();

    function checkSession()
    {
        if(isset($_SESSION["user"]) && isset($_SESSION["logged"]) && $_SESSION["logged"]===true)
        {
            return true;
        }
        return false;
    }
?>
