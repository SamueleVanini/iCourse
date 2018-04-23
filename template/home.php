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
            <link rel='stylesheet' href='/iCourse/assets/css/fullcalendar.css' />
            <link href='/iCourse/assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
			<script src="/iCourse/assets/js/it.js"></script>
			<script src="/iCourse/assets/js/tools.js"></script>
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
                                    <strong>Comunicazioni</strong>
                                </div>
                                <div class="card-body" id="social-box">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

                <script>
                    var eventi = [];
                    var callback_event = (err, response_event)=>{
                        if(err){
                            console.log("Errore: " + err);
                        }else{
                            response_event = JSON.parse(response_event);
                            for(i=0; i<response_event.length; i++){
                                var evento = new Object(); //NON GUARDARE TI PREGO
                                evento.title = response_event[i].Nome;
                                evento.start = response_event[i].Data + 'T' + response_event[i].OraInizio;
                                evento.end = response_event[i].Data + 'T' + response_event[i].OraFine;
                                eventi.push(evento);
                            }//for
                            calendario();
                            createActivityBox(eventi);
                        }//if-else
                    }//callback_get

                    var comunicazioni = [];
                    var callback_communication = (err, response_communication)=>{
                        if(err){
                            console.log("Errore: " + err);
                        }else{
                            response_communication = JSON.parse(response_communication);
                            for(i=0; i<response_communication.length; i++){
                                var comunicazione = new Object(); //NON GUARDARE TI PREGO
                                comunicazione.name = response_communication[i].Nome;
                                comunicazione.title = response_communication[i].Titolo;
                                comunicazioni.push(comunicazione);
                            }//for
                            calendario();
                            createSocialBox(comunicazioni);
                        }//if-else
                    }//callback_get

                    var requestEvent = new Request("/iCourse/src/controller/event_controller.php", "POST", [], callback_event); //inizialize the Request object
                    var requestCommunication = new Request("/iCourse/src/controller/communication_controller.php", "POST", [], callback_communication);
                    requestEvent.send();
                    requestCommunication.send();

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

$user = unserialize($_SESSION["user"]);
$array_privileges = $user->getPrivileges();
foreach($array_privileges as $privileges)
{
    foreach($privileges as $privilege)
    {
        switch($privilege[0]){
            case 2:
                $pathFormEvent = $_SERVER['DOCUMENT_ROOT']."/iCourse/template/form_evento.php";
                require_once($pathFormEvent);
                break;
        }
    }
}
?>
