<?php 
	require_once 'sql_config.php';
	if (isset($_GET['success']) && $_GET['success'] === "false") {
		echo "Username: " . $_GET['username'] . " is already taken. Try again!";
	} 
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		echo "POST_REQUEST!<br>";
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo $_POST['username'] . "<br>";
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		echo $hashed_password . "<br>";
		$stmt = mysqli_prepare($mysqli, "INSERT INTO Users (username, password) VALUES (?, ?)");
		mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);
		$action = mysqli_stmt_execute($stmt);
		if ($action) {
			header("Location: index.php?success=true");
		} else {
			header("Location: register.php?success=false&username=" . $username);
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1> Register </h1>
	<form method="POST" action="register.php">
		<label for="username">Username:</label>
		<input type="text" name="username">
		<label for="password">Password:</label>
		<input type="password" name="password">
		<button>Submit</button>
	</form>
	<a href="index.php">Returning User? Login Here</a>
</body>
</html>