<?php
    $path1 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
    $path2 = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/models/priviliged_user_model.php";
    require_once($path1);
    require_once($path2);

    if(!checkSession())
    {
        header("Refresh: 3; url = /iCourse/template", true, 301);
        echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
    }
    else
    {?>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title> iCourse </title>

            <!-- CSS -->
            <script src='/iCourse/assets/js/jquery.min.js'></script>
            <script src='/iCourse/assets/js/moment.min.js'></script>
            <script src='/iCourse/assets/js/fullcalendar.js'></script>
            <link rel="stylesheet" href="/iCourse/assets/css/bootstrap.min.css" type="text/css">
            <link href="/iCourse/assets/css/album.css" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <script src="/iCourse/assets/js/request.js"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
			<script src="/iCourse/assets/js/tools.js"></script>
        </head>
        <body>
            <?php include('header.php'); ?>
            <main role="main">
               
            </main>

                <script>
                    var callback_usr = (err, response_usr)=>{
                        if(err){
                            console.log("Errore: " + err);
                        }else{
                            creaTabellaUsr(response_usr);
                        }//if-else
                    }//callback_get

                    var requestUsr = new Request("/iCourse/src/controller/event_controller.php", "POST", [], callback_usr);
                    requestUsr.send();
            </script>
                <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="/iCourse/assets/js/popper.min.js"></script>
                <script src="/iCourse/assets/js/bootstrap.min.js"></script>
                <script src="/iCourse/assets/js/holder.min.js"></script>
            </body>
    </html>
<?php
}
?>
