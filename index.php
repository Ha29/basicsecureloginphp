<?php 
	require_once 'sql_config.php';
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		echo "POST_REQUEST!<br>";
		$username = $_POST['username'];
		$password = $_POST['password'];
		$stmt = mysqli_prepare($mysqli, "select * from Users where username = ?");
		mysqli_stmt_bind_param($stmt, 's', $username);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$parsed_results = mysqli_fetch_row($result);
		if ($parsed_results) {
			$stored_hash = $parsed_results['2'];
			if (password_verify($password, $stored_hash)) {
				echo "Welcome, " . $username . "!" . "</br>";
			} else {
				echo "Incorrect username/password";
			}
		} else {
			echo 'User ' . $username . ' does not exist';
		}
	} else {
		echo "OTHER_REQUEST!";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1> Welcome! Login Here: </h1>
	<form method="POST" action="index.php">
		<label for="username">Username:</label>
		<input type="text" name="username">
		<label for="password">Password:</label>
		<input type="password" name="password">
		<button>Submit</button>
	</form>
	<a href="register.php">New User? Register Here</a>
</body>
</html>