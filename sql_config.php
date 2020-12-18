<?php

define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB_NAME", "blog_project");

$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DB_NAME);
if ($mysqli === false) {
	die("Error: No connection" . $mysqli_connect_error());
} else {
	echo "SQL CONNECTED!<br>";
}