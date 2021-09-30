<?php
	require 'config.php';

	if( isset($_POST['submit']) ) {
		$firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
		$lastname = mysqli_real_escape_string($con, trim($_POST['lastname']));
		$email = mysqli_real_escape_string($con, trim($_POST['email']));
		$username = mysqli_real_escape_string($con, trim($_POST['username']));
		$password  = mysqli_real_escape_string($con, trim($_POST['password']));
		// Get current datetime
		$dt = new DateTime(null, new DateTimeZone('Europe/Amsterdam'));
		$datetime = $dt->format('d-m-Y H:i:s');
		// Keep track of validated values
		$valid = array('firstname'=>false, 'lastname'=>false, 'email'=>false, 'username'=>false, 'password'=>false);
		// Validate firstname
		if( !empty($firstname) ) {
		 	if( strlen($firstname) >= 2 && strlen($firstname) <= 40 ) {
		   		if( !preg_match('/[^a-zA-Z\s]/', $firstname) ) {
		     		$valid['firstname'] = true;
		     		echo 'Firstname is OK! <br/>';
		   		}else{
		     		echo 'Firstname can contain only letters!<br/>';
		   		}
		 	}else{
		   		echo 'Firstname must be between 2 and 40 characters long!<br/>';
		 	}
		}else{
		 	echo 'Firstname cannot be blank!<br/>';
		}
		// Validate lastname
		if( !empty($lastname) ) {
		 	if( strlen($lastname) >= 2 && strlen($lastname) <= 40 ) {
		   		if( !preg_match('/[^a-zA-Z\s]/', $lastname) ) {
		     		$valid['lastname'] = true;
		     		echo 'Lastname is OK! <br/>';
		   		}else{
		     		echo 'Lastname can contain only letters!<br/>';
		   		}
		 	}else{
		   		echo 'Lastname must be between 2 and 40 characters long!<br/>';
		 	}
		}else{
		 	echo 'Lastname cannot be blank!<br/>';
		}
		// Validate email
		if( !empty($email) ) {
		 	if( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		   		$valid['email'] = true;
		   		echo 'E-mail is OK!<br/>';
		 	}else{
		   		echo 'E-mail is invalid!<br/>';
		 	}
			}else{
		 		echo 'E-mail cannot be blank!<br/>';
			}
		// Validate username
		if( !empty($username) ) {
		 	if( strlen($username) >= 2 && strlen($username) <= 16 ) {
		   		if( !preg_match('/[^a-zA-Z\d_.]/', $username) ) {
		     		$valid['username'] = true;
		     		echo 'Username is OK! <br/>';
		   		}else{
		     		echo 'Username can contain only letters!<br/>';
		   		}
		 	}else{
		   		echo 'Username must be between 2 and 16 characters long!<br/>';
		 	}
		}else{
		 	echo 'Username cannot be blank!<br/>';
		}
		// Validate password
		if( !empty($password) ) {
		 	if( strlen($password) >= 5 && strlen($password) <= 32 ) {
		   		$valid['password'] = true;
		   		echo 'Password is OK!<br/>';
		 	}else{
		   		echo 'Password must be between 5 and 32 characters!<br/>';
		 	}
		}else{
		 	echo 'Password cannot be blank!<br/>';
		}
		if($valid['firstname'] && $valid['lastname'] && $valid['email'] && $valid['username'] && $valid['password']) {
			$query = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `username`, `password`) VALUES ('$firstname','$lastname','$email','$username','$password')";
			$result = mysqli_query($con, $query) or die('Cannot insert data into database. '.mysqli_error($con));
			if($result) {
			  	echo 'Data inserted into database.';
			  	mysqli_free_result($result);
			  	header('Location:../index.php');
			}
		}
	}

	if( isset($_GET['del']) ) {
		$id = $_GET['del'];
		$query = "DELETE FROM `users` WHERE id=$id";
		$result = mysqli_query($con, $query) or die('Cannot delete data from database. '.mysqli_error($con));
		if($result) {
		  	echo 'Data deleted from database.';
		  	mysqli_free_result($result);
		  	header('Location:../index.php');
		}
	}

	if( isset($_POST['btnupdate']) ) {
		$id = $_GET['id'];
		$firstname = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$email     = $_POST['email'];
		$username  = $_POST['username'];
		$password  = $_POST['password'];
		$query  = "UPDATE `users` SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', password='$password' WHERE id=$id";
		$result = mysqli_query($con, $query) or die('Cannot update data in database. '.mysqli_error($con));
		$user   = mysqli_fetch_assoc($result);
		if($result) header('Location:../index.php');
	}
	   
	if( isset($_POST['login']) ) {
		$username = $_POST['username']; //filled in username
		$password = $_POST['password']; //filled in password

		$query = "SELECT username FROM `users` WHERE username='$username'";
		$result = mysqli_query($con, $query) or die('Cannot update data in database. '.mysqli_error($con));

		$query2 = "SELECT `password` FROM `users` WHERE username='$username'";
		$result2 = mysqli_query($con, $query2) or die('Cannot update data in database. '.mysqli_error($con));





		if($result->num_rows == 0 || $result2->num_rows == 0) {
			//not found//
			echo("login failed,");
			echo(", user: " . $result->num_rows);
			echo(", pass: " . $result2->num_rows);


		} elseif($result->num_rows == 1 && $result2->num_rows == 1)  {
			//found//
			echo("logged in");
			echo(", user: " . $result->num_rows);
			echo(", pass: " . $result2->num_rows);
		}
	}

?>