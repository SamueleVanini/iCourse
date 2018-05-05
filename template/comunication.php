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

    </head>
    <body>
		<?php include('header.php'); ?>
	    <main role="main">
				<div class="container container-new">
					<div class="row">
						<div class="col-xl-1"></div>
						<div class="col-xl-5">
							<div>
								<h2>Titolo della comunicazione</h2>
								<p style="line-height:5px">Codice della Comunicazione</p><br>
							</div>
							<div>
								<h5><b>Docente referente</b> : </h5>
								<h5><b>Corso</b> : </h5>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-1"></div>
						<div class="col-xl-10 container-new">
							<hr />
							<div>
							    <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod
								tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrum exercitationem ullam corporis suscipit laboriosam,
								nisi ut aliquid ex ea commodi consequatur.
								Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod
								tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrum exercitationem ullam corporis suscipit laboriosam,
								nisi ut aliquid ex ea commodi consequatur.
								Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod
								tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrum exercitationem ullam corporis suscipit laboriosam,
								nisi ut aliquid ex ea commodi consequatur.
								Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod
								tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrum exercitationem ullam corporis suscipit laboriosam,
								nisi ut aliquid ex ea commodi consequatur.</p>
							</div>
							<hr />
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-1 container-new"></div>
						<div class="col-xl-10 container-new"> <?php /* se si è loggati come studente, col-md deve avere il valore di 10 */ ?>
							<div> <h4> Materiali da scaricare </h4> </div>
							<table class="table table-hover">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Nome file</th>
								  <th scope="col">Dimensione</th>
								  <th scope="col">Data aggiunta</th>
								  <th scope="col"></th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">1</th>
								  <td>materiale1.pdf</td>
								  <td>2 MB</td>
								  <td>2/02/2018</td>
								  <td><button type="submit" class="btn btn-primary btn-accedi btn-download">Download</button></td>
								</tr>
								<tr>
								  <th scope="row">2</th>
								  <td>materiale2.pdf</td>
								  <td>3 MB</td>
								  <td>2/02/2018</td>
								  <td><button type="submit" class="btn btn-primary btn-accedi btn-download">Download</button></td>
								</tr>
								<tr>
								  <th scope="row">3</th>
								  <td>materiale3.pdf</td>
								  <td>1 MB</td>
								  <td>2/02/2018</td>
								  <td><button type="submit" class="btn btn-primary btn-accedi btn-download">Download</button></td>
								</tr>
							  </tbody>
							</table>
						</div>
						<!--<?php include('caricaFile.php'); /* se si è loggati come docente, sarà possibile caricare dei materiali */ ?>-->
					</div>
				</div>
	    </main>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="/iCourse/assets/js/jquery-slim.min.js"><\/script>')</script>
		<script src="/iCourse/assets/js/popper.min.js"></script>
		<script src="/iCourse/assets/js/bootstrap.min.js"></script>
    </body>

</html>
