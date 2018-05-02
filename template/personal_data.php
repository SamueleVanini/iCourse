<?php
    $var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
    require_once($var);

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
        </head>
        <body>
                <?php include('header.php'); ?>
                <main role="main">
                    <div class="container-fluid">
                        <div class="row contenuto-dashboard">
                            <div class="col-xl-2 side-box">
                            </div>
                            <div class= "col-xl-8">
                                <div class="card card-style">
                                    <div class="card-header side-box-header">
                                        <strong>Dati attuali</strong>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <i>ancora da fare</i>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row contenuto-dashboard">
                            <div class="col-xl-2 side-box">
                            </div>
                            <div class= "col-xl-8">
                                <div class="card card-style">
                                    <div class="card-header side-box-header">
                                        <strong>Modifica dati</strong>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <form method="POST" action="/iCourse/src/controller/personal_data_controller.php"> <!-- File da contattare per il login -->
                                                <div class="form-group">
                                                    <label for="matricola">Cambia password</label>
                                                    <input type="password" class="form-control" name="newpassword" placeholder="nuova password">
                                                    <input type="password" class="form-control" name="confnewpassword" placeholder="conferma nuova password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="matricola">Cambia mail</label>
                                                    <input type="text" class="form-control" name="newmail" placeholder="nuova mail">
                                                </div>
                                                <div class="form-group">
                                                    <label for="matricola">Conferma password attuale</label>
                                                    <input type="password" class="form-control" name="actpassword" placeholder="password attuale">
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-accedi">Aggiorna</button>
                                             </form>
                                         </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 side-box">
                            </div>
                        </div>
                    </div>
                </main>

                <?php include('footer.php'); ?>

            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="/iCourse/assets/js/popper.min.js"></script>
            <script src="/iCourse/assets/js/bootstrap.min.js"></script>
            <script src="/iCourse/assets/assets/js/holder.min.js"></script>
        </body>
    </html>
<?php } ?>
