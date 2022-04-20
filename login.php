<?php

	//if the form has been submitted
	if (isset($_POST['submitted'])){
		if ( !isset($_POST['username'], $_POST['password']) ) {
		// Could not get the data that should have been sent.
		 exit('Please fill both the username and password fields!');
	    }
		// connect DB
		require_once ("connectdb.php");
		try {
		//Query DB to find the matching username/password
		//using prepare/bindparameter to prevent SQL injection.
			$stat = $db->prepare('SELECT password FROM cvs WHERE name = ?');
			$stat->execute(array($_POST['username']));
		    
			// fetch the result row and check 
			if ($stat->rowCount()>0){  // matching username
				$row=$stat->fetch();

				$a = $_POST['password'];
				$b = $row['password'];

				if ($a == $b){ //matching password
					
					//??recording the user session variable and go to loggedin page?? 
				  session_start();
					$_SESSION["username"]=$_POST['username'];
					header("Location:cv.php");
					exit();
				
				} else {
				 echo "<p style='color:red'>Error logging in, password does not match </p>";
 			    }
		    } else {
			 //else display an error
			  echo "<p style='color:red'>Error logging in, Username not found </p>";
		    }
		}
		catch(PDOException $ex) {
			echo("Failed to connect to the database.<br>");
			echo($ex->getMessage());
			exit;
		}

  }
?>
<!-- a HTML part -->
<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<a href="index.php">Home</a>
	<title>Login</title>
</head>

	<h2>Login</h2>

<body>
<!-- a HTML form that allows the user to enter their username and password for log in.-->
<form action="login.php" method="post">

	<label>Name:</label>
	<input type="text" name="username" size="15" maxlength="25" />
    <label>Password:</label>
	<input type="password" name="password" size="15" maxlength="25" />
	
	<input type="submit" value="Login" />
	<input type="reset" value="Clear"/>
    <input type="hidden" name="submitted" value="TRUE" />
	<p>
	</p>

</form>
</body>
</html>
