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
	<title>C-Shop ● Order newest products today</title>
</head>
<body>
	<h1>Home</h1>

	<?php if (isset($user)): ?>
		<p>You are now Loged In. hello <?= htmlspecialchars($user["name"]) ?></p>
		<p><a href="logout.php">Log out</a></p>
	<?php else: ?>

		<p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

	<?php endif; ?>

</body>
</html>