<?php

// Validating name
if (empty($_POST["name"])) {
	die("Name is required");
	// code...
}

// Validating email
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	die("Valid email is required");
	// code...
}

// Validating password
if (strlen($_POST["password"]) < 5){
	die("Password Must be at least 5 characters");
}

// Validating password containts letter
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
	die("Password mush contain at least one latter");
}

// Validating password containts number
if ( ! preg_match("/[0-9]/", $_POST["password"])){
	die("Password mush contain at least one latter");
}

// Validating password confirnation
if ($_POST["password"] !== $_POST["password_confirmation"]) {
	die("Password must match!");
	// code...
}

// Password secure
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
       VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
	die("SQL error: " . $mysqli->error);
	// code...
}

$stmt->bind_param("sss",
                   $_POST["name"],
                   $_POST["email"],
                   $password_hash);

if ($stmt->execute()) {

  // echo "SignUp Seccessful";
	header("Location: signup-success.html");
	exit;
} else {
	if ($mysqli->errno === 1062){
		// die("This email is already used!");
		header("Location: error-signup.php");
	}
	die($mysqli->error . "" . $mysqli->errno);
}


// print_r($_POST);
// var_dump($password_hash);