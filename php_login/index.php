<?php 
	require 'config/config.php';

?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='description' content='Basic loginsystem'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv='x-ua-compatible' content='ie=edge'>
	<link href='css/bootstrap.min.css' rel='stylesheet'>
	<title>Basic Login System</title>
</head>
<body>
	<div class='container' style="margin: auto; width: 95%;">
		<div class='row'>
			<div class='col-lg-12 col-lg-offset-2'>
				<div class='col-lg-12 col-lg-offset-2'>
					<h3 hidden>User Data</h3>
					<hr>
					<div class='table-responsive'>
						<table class='table table-striped'>
							<thead hidden>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>E-mail</th>
									<th>Username</th>
									<th>Password</th>
								</tr>
							</thead>
							<tbody hidden>
								<?php
									$query = "SELECT * FROM `users`";
									$result = mysqli_query($con, $query) or die('Cannot fetch data from database. '.mysqli_error($con));
									if(mysqli_num_rows($result) > 0) {
									 	while($user = mysqli_fetch_assoc($result)) {
									   		echo '<tr>';
									  		echo '<td>' . $user['firstname']  . '</td>';
									  		echo '<td>' . $user['lastname']   . '</td>';
									   		echo '<td>' . $user['email']      . '</td>';
									   		echo '<td>' . $user['username']   . '</td>';
									   		echo '<td>' . $user['password']   . '</td>';
									   		echo '</tr>';
									 	}
									}
									mysqli_free_result($result);
									mysqli_close($con);
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class='row' style="float: left; ">
			<div class='col-lg-8 col-lg-offset-2' >
				<div class='col-lg-6 col-lg-offset-3' style="width: 500px;" >
					<h3>Signup</h3>
					<hr/>
					<form name='signup' id='signup' action=' config/actions.php' method='post'>
						<div class='form-group' >
							<label for='firstname'>Firstname</label>
							<input name='firstname' id='firstname' type='text' class='form-control' placeholder='firstname' required />
						</div>
						<div class='form-group'>
							<label for='lastname'>Lastname</label>
							<input name='lastname' id='lastname' type='text' class='form-control' placeholder='lastname' required />
						</div>
						<div class='form-group'>
							<label for='email'>E-mail</label>
							<input name='email' id='email' type='text' class='form-control' placeholder='email' required />
						</div>
						<div class='form-group'>
							<label for='username'>Username</label>
							<input name='username' id='username' type='text' class='form-control' placeholder='username' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
						</div>
						<div class='form-group'>
							<label for='password'>Password</label>
							<input name='password' id='password' type='password' class='form-control' placeholder='password' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
						</div>
						<div class='form-group'>
							<button name='submit' id='submit' class='btn btn-primary btn-block'>Sign Up</button>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<div class='row' >
			<div class='col-lg-8 col-lg-offset-2'>
				<div class='col-lg-6 col-lg-offset-3'>
					<h3>Login</h3>
					<hr/>
					<form name='signup' id='signup' action=' config/actions.php' method='post'>
						<div class='form-group'>
							<label for='username'>Username</label>
							<input name='username' id='username' type='text' class='form-control' placeholder='username' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
						</div>
						<div class='form-group'>
							<label for='password'>Password</label>
							<input name='password' id='password' type='password' class='form-control' placeholder='password' style='cursor:text; background-color:#fff;' onfocus='this.removeAttribute("readonly");' readonly required />
						</div>
						<div class='form-group'>
							<button name='login' id='login' class='btn btn-primary btn-block'>Login</button>
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>