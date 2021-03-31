<?php 
include 'dbconnect.php';
session_start();

if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $connect->prepare('SELECT user_id, password FROM users WHERE username = ?')) {

	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (($_POST['password'] === $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		// echo 'Welcome ' . $_SESSION['name'] . '!';
		header("Location: ../pages/admin_page.php");
	} else {
		// echo 'Incorrect password!';
		echo '<script type="text/javascript">alert("Wrong Password");window.location=\'../index.php\';</script>';
	}
} else {
	// echo 'Incorrect username!';
	echo '<script type="text/javascript">alert("Wrong UserName!");window.location=\'../index.php\';</script>';

}

	$stmt->close();
}

?>