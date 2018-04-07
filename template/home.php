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
            <link rel='stylesheet' href='/iCourse/assets/css/fullcalendar.css' />
            <link href='/iCourse/assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
			<script src="/iCourse/assets/js/it.js"></script>
        </head>
        <body>
            <?php include('header.php'); ?>
            <main role="main">
                <div class="container-fluid">
                <div class="row contenuto-dashboard">
                    <div class="col-xl-2 side-box">
                        <div class="card card-style">
                            <div class="card-header side-box-header">
                                <strong>Corsi</strong>
                            </div>
                            <div class="card-body" id="activity-box">
                                
                            </div>
                        </div>
                    </div>
                    <div class= "col-xl-8">
                        <div id="calendar"></div>
                    </div>
                    <div class="col-xl-2 side-box">
                        <div class="card card-style">
                          <div class="card-header side-box-header">
                            <strong>Social</strong>
                          </div>
                          <div class="card-body">
                            <blockquote class="blockquote mb-0">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            </blockquote>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                
                <!-- frame form creazione corso -->
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary btn-lg btn-dark float-right creazione-corso" onclick="showForm()">Crea corso</button>
                    <div class="container inserimento-evento" id="form-evnt">
                        <form action="" method="POST">
                        	<div class="form-group">
                                <label for="nomeEvento">Nome evento</label>
                                <input type="text" class="form-control" id="nomeEvento" placeholder="Nome dell'evento che si vuole creare">
                            </div>
                            <div class="form-group">
                                <label for="dataInizioEvento">Inizio evento</label>
                                <input type="date" class="form-control" id="dataInizioEvento">
                                <input type="time" class="form-control" id="oraInizioEvento">
                            </div>
                            <div class="form-group">
                                <label for="dataFineEvento">Fine evento</label>
                                <input type="date" class="form-control" id="dataFineEvento">
                                <input type="time" class="form-control" id="oraFineEvento">
                            </div>
                            <button type="submit" class="btn btn-primary">Crea evento</button>
                        </form>
                    </div>
                </div>
                
                </main>

                <script>
                    var eventi = [];
                    var callback_get = (err, response)=>{
                        if(err){
                            console.log("Errore: " + err);
                        }else{
                            response = JSON.parse(response);
                            var evento = new Object();
                            for(i=0; i<response.length; i++){
                                evento.title = response[i].Nome;
                                evento.start = response[i].Data + 'T' + response[i].OraInizio;
                                evento.end = response[i].Data + 'T' + response[i].OraFine;
                                eventi.push(evento);
                            }//for
                            calendario();
                            createActivityBox(eventi);
                        }//if-else
                    }//callback_get
                    
                    var request = new Request("/iCourse/src/controller/event_controller.php", "POST", [], callback_get); //inizialize the Request object
                    request.send();
                    
                    function calendario(){
                        $('#calendar').fullCalendar({
                            defaultDate: new Date(),
                            theme: true,
                            height: 650,
                            lang: 'it',
                            themeSystem:'bootstrap4',
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listMonth'
                            },
                            editable: false,
                            eventLimit: true, // allow "more" link when too many events
                            events: eventi
                        });
                    }//calendario
                    
                    /**
                     * Funzione che inserisce le attività nell'activity-box.
                     * @param eventi Array di eventi in json.
                    */
                    function createActivityBox(eventi){
                        var intActivty1 = '<h4>I tuoi corsi</h4><ul>';
                        var intActivty2 = '<h4>Altri corsi</h4><ul>';
                        var activity = '';
                        for(i=0; i<eventi.length; i++){
                            activity += '<li>' + eventi[i].title + '</li>';
                        }//for
                        activity += '</ul>';
                        
                        document.getElementById('activity-box').innerHTML = intActivty1 + activity;
                    }//createActivityBox

                    /**
                     * Funzione che mostra o nasconde il form di inserimento eventi.
                    */
                    function showForm(){
                        var display = document.getElementById('form-evnt').style.display;
                        if(!display || display == "none"){
                        	document.getElementById('form-evnt').style.display = "block";
                        }else{
                            document.getElementById('form-evnt').style.display = "none";
                        }//if-else
                    }//showForm
            </script>
                <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="/iCourse/assets/js/popper.min.js"></script>
                <script src="/iCourse/assets/js/bootstrap.min.js"></script>
                <script src="/iCourse/assets/js/holder.min.js"></script>
            </body>
    </html>
<?php } ?>
