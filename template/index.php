<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
require_once($var);
if(checkSession())
{
    header("Location: /iCourse/template/home.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> iCourse </title>
        <!-- CSS -->
        <link rel="stylesheet" href="/iCourse/assets/css/bootstrap.min.css" type="text/css">
        <link href="/iCourse/assets/css/album.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="/iCourse/assets/js/request.js"></script>
    </head>
    <body>
        <?php include('header.php'); ?>
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Attività Pomeridiane</h1>
                    <p class="lead text-muted">Benvenuti in iCourse, la piattaformata di gestione per i corsi pomeridiano dell'istituto Francesco Severi</p>
                      <!--<p>
                        <a href="#" class="btn btn-primary my-2">Main call to action</a>
                        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                      </p>-->
                </div>
              </section>

              <div class="album py-5 bg-light">
                <div class="container" id="tabella_corsi">
                    <script>
                        var card1 = "<div class=\"col-md-4\"><div class=\"card mb-4 box-shadow\"><img class=\"card-img-top\" data-src=\"holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail\" alt=\"Card image cap\"><div class=\"card-body\"><h4 class=\"card-text\">";
                        var card2 = "</h4><p class=\"card-text\" id=\"contenuto\">";
                        var card3 = "</p><div class=\"d-flex justify-content-between align-items-center\"><div class=\"btn-group\"><button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Vai all'attività</button></div><small class=\"text-muted\">";
                        var card4 = "</small></div></div></div></div>";
                        var callback_get = (err, response)=>{
                            if(err){
                                console.log("Errore: " + err);
                            }else{
                                response = JSON.parse(response);
                                var box = "";
                                var i = 0;
                                box += "<div class=\"row\">";
                                for(course in response) {
                                    box += card1;
                                    box += response[i].Nome;
                                    box += card2;
                                    box += response[i].Descrizione;
                                    box += card3;
                                    box += "Data";
                                    box += card4;
                                }
                                box += "<\div>";
                                document.getElementById('tabella_corsi').innerHTML = box;
                            }//if-else
                           }//callback_get

                        var request = new Request("/iCourse/src/controller/index_controller.php", "POST", [], callback_get); //inizialize the Request object
                        request.send();
                    </script>
                </div>
              </div>
        </main>

        <?php include('footer.php'); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="/iCourse/assets/js/jquery-slim.min.js"><\/script>')</script>
        <script src="/iCourse/assets/js/popper.min.js"></script>
        <script src="/iCourse/assets/js/bootstrap.min.js"></script>
        <script src="/iCourse/assets/js/holder.min.js"></script>
    </body>
</html>
