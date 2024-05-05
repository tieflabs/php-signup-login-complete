<?php

session_start();

// print_r($_SESSION);

if (isset($_SESSION["user_id"])) {
	// code...

	$mysqli = require __DIR__ . "/database.php";

	$sql = "SELECT * FROM user
	        WHERE id = {$_SESSION["user_id"]}";

	$result = $mysqli->query($sql);

	$user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>C-Shop ● 404 Page Error</title>
</head>
<body>


	<?php if (isset($user)): ?>
		<p>hello <?= htmlspecialchars($user["name"]) ?> The link you followed is broken! or removed</p>

		<p><a href="index.php">Go Home</a></p>
	<?php else: ?>

		<p>
			The link you followed is broken! or removed. would you like to
			<a href="login.php">Log in</a>  or 
			<a href="signup.html">sign up</a>
		</p>

	<?php endif; ?>

	<h1>404</h1>
	<h4>This page dose note exist</h4>

</body>
</html>