<header>
	<div class="collapse bg-dark" id="navbarHeader">
		<div class="container"> </div>
	</div>
	<div class="navbar navbar-dark bg-dark box-shadow">
		<div class="container d-flex justify-content-between">
			<a href="/iCourse/template" class="navbar-brand d-flex align-items-center">
				<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
					<path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
					<path d="M0 0h24v24H0z" fill="none"/>
				</svg>
				<strong style="margin-left:10px">iCourse</strong>
			</a>
			<button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#login" aria-expanded="false" aria-controls="collapseExample">
				<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
					<path d="M0 0h24v24H0z" fill="none"/>
				</svg>
			</button>
		</div>
		<div class="login">
			<div class="collapse" id="login">
				<?php
					$var = $_SERVER['DOCUMENT_ROOT']."/iCourse/src/controller/session_controller.php";
					require_once($var);
					if(!checkSession())
					{?>
						<div class="card card-body cardLogin">
						<form method="POST" action="/iCourse/src/controller/user_controller.php"> <!-- File da contattare per il login -->
							<div class="form-group">
								<label for="matricola">Matricola</label>
								<input type="text" class="form-control" id="matricola" aria-describedby="matr" placeholder="matricola fornita dall'istituto" name="matricola">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="password">
							</div>
							<button type="submit" class="btn btn-primary btn-accedi">Accedi</button>
						</form>
					<?php }
					else
					{?>
						<a href="/iCourse/template/student_home.php" class="navbar-brand d-flex align-items-right">Home</a>
						<a href="/iCourse/template/personal_data.php" class="navbar-brand d-flex align-items-right">Dati personali</a>
						<br>
						<form action="/iCourse/src/logout.php">
						<button class="btn btn-danger">Logout</button>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</header>
