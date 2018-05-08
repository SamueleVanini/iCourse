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
		<script src="/iCourse/assets/js/tools.js"></script>
	    <script src="/iCourse/assets/js/holder.min.js"></script>
    </head>
    <body>
		<?php include('header.php'); ?>
	    <main role="main" id="communicationBody">
				<div class="container container-new">
					<div class="row">
						<div class="col-xl-1"></div>
						<div class="col-xl-5">
							<div>
								<h2 id="communicationTitle">Titolo della comunicazione</h2>
								<p id="communicationCode" style="line-height:5px">Codice della Comunicazione</p><br>
							</div>
							<div>
								<h5 id="communicationTeacher"><b>Docente referente</b> : </h5>
								<h5 id="communicationCourse"><b>Corso</b> : </h5>
								<h5 id="communicationDate"><b>Data di pubblicazione</b> : </h5>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-1"></div>
						<div class="col-xl-10 container-new">
							<hr />
							<div>
							    <p id="communicationDescription"></p>
							</div>
							<hr />
						</div>
					</div>

					<div class="row">
						<div class="col-xl-1 container-new"></div>
						<div id="Allegati" class="col-xl-10 container-new"> <?php /* se si è loggati come studente, col-md deve avere il valore di 10 */ ?>
							<div> <h4> Allegati della comunicazione </h4> </div>
							<table class="table table-hover">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Nome file</th>
								  <th scope="col">Data aggiunta</th>
								  <th scope="col"></th>
								</tr>
							  </thead>
							  <tbody id="tabellaAllegati">
								
							  </tbody>
							</table>
						</div>
					</div>
				</div>
	    </main>
		<div class="alert alert-danger" role="alert" id="errore">
			La comunicazione richiesta è inesistente o non appartiene a nessun corso a cui tu sei iscritto, verrai reindirizzato verso la pagina home
		</div>
		<script>
			var callback_activity = (err, response_communication)=>{
					if(err){
							console.log("Errore: " + err);
					}else{
							response_communication = JSON.parse(response_communication);
							createCommunicationPage(response_communication);
					}//if-else
			}//callback_get
			var requestActivity = new Request("/iCourse/src/controller/communication_controller.php", "GET", [{"name":"communication_id", "value":((window.location.search.substr(1)).split("="))[1]}], callback_activity); //inizialize the Request object
			requestActivity.send();
		</script>
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script>window.jQuery || document.write('<script src="/iCourse/assets/js/jquery-slim.min.js"><\/script>')</script>
	    <script src="/iCourse/assets/js/popper.min.js"></script>
	    <script src="/iCourse/assets/js/bootstrap.min.js"></script>
    </body>

</html>
