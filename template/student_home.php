<?php
session_start();
if(!(isset($_SESSION["user"]) && isset($_SESSION["logged"]) && $_SESSION["logged"]=true))
{
    header("Refresh: 3; url = ./index.html", true, 301);
    echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <p>Esisto</p>
</body>
</html>