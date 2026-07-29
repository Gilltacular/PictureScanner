<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	session_start();	// start php session

	if (isset($_POST['email'], $_POST['p'])) {
		$email = $_POST['email'];
		$password = $_POST['p'];

		if (login($email, $password, $mysqli) == true) {
			// login successful
			header('Location: ../repo.php');
		} else {
			// login failed
			header('Location: ../login.php?error=1');
		}
	} else {
		// incorrect POST variable sent to page
		echo 'Invalid Request';
	}
?>