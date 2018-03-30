<?php

$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
require_once($var);

if(!checkSession())
{
    header("Refresh: 3; url = ./index.html", true, 301);
    echo "Devi eseguire il login per accedere a questa pagina, redirect in 3 secondi...";
}
else
{?>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../../../favicon.ico">

	    <title> iCourse </title>

	    <!-- CSS -->
        <script src='../assets/js/jquery.min.js'></script>
        <script src='../assets/js/moment.min.js'></script>
		<script src='../assets/js/fullcalendar.js'></script>
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="../assets/css/style.css" type="text/css">
	    <link href="../assets/css/album.css" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <script src="../assets/js/request.js"></script>
		<link rel='stylesheet' href='../assets/css/fullcalendar.css' />
        <link href='../assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

    </head>
    <body>
	    <header>
	        <div class="collapse bg-dark" id="navbarHeader">
			    <div class="container"> </div>
			</div>
			<div class="navbar navbar-dark bg-dark box-shadow">
				<div class="container d-flex justify-content-between">
				    <a href="#" class="navbar-brand d-flex align-items-center">
						<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</svg>
						<strong style="margin-left:10px">iCourse</strong>
				  	</a>

				</div>
			</div>
	    </header>
	    <main role="main">
	        <div class="container-fluid">
			<div class="row contenuto-dashboard">
				<div class="col-xl-2 side-box">
				   <div class="card card-style">
					  <div class="card-header side-box-header">
						<strong>Gestione Corsi</strong>
					  </div>
					  <div class="card-body">
						<blockquote class="blockquote mb-0">
						  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
						</blockquote>
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
			}//if-else
		}//callback_get
		
		var request = new Request("../src/controller/event_controller.php", "POST", [], callback_get); //inizialize the Request object
		request.send();
		
        $(document).ready(function() {

          $('#calendar').fullCalendar({
            defaultDate: new Date(),
            theme: true,
            height:'parent',
            monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
            monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'],
            dayNames: ['Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica'],
            dayNamesShort: ['Lun','Mar','Mer','Gio','Ven','Sab','Dom'],
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
        });
		</script>
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="../assets/js/popper.min.js"></script>
	    <script src="../assets/js/bootstrap.min.js"></script>
	    <script src="../assets/js/holder.min.js"></script>
    </body>
</html>
<?php } ?>