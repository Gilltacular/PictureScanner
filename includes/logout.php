<?php
	include_once 'functions.php';
	session_start();

	// remove all session variables
	$_SESSION = array();

	// get session parameters
	$params = session_get_cookie_params();

	// delete cookie
	setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

	// end session
	session_destroy();
	header('Location: ../login.php');
?>