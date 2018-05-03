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
	    <script src="/iCourse/assets/js/holder.min.js"></script>
			<script src="/iCourse/assets/js/tools.js"></script>
    </head>
    <body>
		<?php include('header.php'); ?>
	    <main role="main">
				<div class="container container-new">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<img id="activity_image" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Corso" class="img-thumbnail img-center">
						</div>
						<div class="col-md-5">
							<div>
								<h2 id="title">Titolo del corso</h2>
							</div>
							<div>
								<h5> Dettagli tecnici</h5>
							</div>
							<div>
								<p id="activity_spec"></p>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10 container-new">
							<div> <h4> Descrizione del Corso </h4> </div>
							<div>
							    <p id="activity_description"></p>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10 container-new">
							<div> <h4> Eventi </h4> </div>
							<div class="list-group" id="activity_moments">

							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10 container-new">
							<div> <h4> Materiali online </h4> </div>
							<table class="table table-hover" id="tabellaFile">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Nome file</th>
								  <th scope="col">Data aggiunta</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">1</th>
								  <td>materiale1.pdf</td>
								  <td>2/02/2018</td>
								</tr>
								<tr>
								  <th scope="row">1</th>
								  <td>materiale2.pdf</td>
								  <td>2/02/2018</td>
								</tr>
								<tr>
								  <th scope="row">1</th>
								  <td>materiale3.pdf</td>
								  <td>2/02/2018</td>
								</tr>
							  </tbody>
							</table>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
	    </main>
		<script>
			var activity = [];
			var callback_activity = (err, response_activity)=>{
					if(err){
							console.log("Errore: " + err);
					}else{
							response_activity = JSON.parse(response_activity);
							createActivityPage(response_activity);
					}//if-else
			}//callback_get
			var requestActivity = new Request("/iCourse/src/controller/activity_controller.php", "GET", [{"name":"activity_id", "value":((window.location.search.substr(1)).split("="))[1]}], callback_activity); //inizialize the Request object
			requestActivity.send();
		</script>
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script>window.jQuery || document.write('<script src="/iCourse/assets/js/jquery-slim.min.js"><\/script>')</script>
	    <script src="/iCourse/assets/js/popper.min.js"></script>
	    <script src="/iCourse/assets/js/bootstrap.min.js"></script>
    </body>
</html>
