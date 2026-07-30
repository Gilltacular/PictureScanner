<?php
	include_once 'db_connect.php';
	include_once 'psl-config.php';

	$error_msg = "";

	if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
		// validate and sanitize passed data
		$username = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['username']);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// invalid email
			$error_msg .= '<p class="error">The email address you entered is invalid.</p>';
		}

		$password = $_POST['p'];

		if (strlen($password) != 128) {
			// make sure password is 128 characters for hash
			$error_msg .= '<p class="error">Invalid password configuration.</p>';
		}

		$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
		$stmt = $mysqli->prepare($prep_stmt);

		// check existing email
		if ($stmt) {
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();

			if ($stmt->num_rows == 1) {
				$error_msg .= '<p class="error">A user with this email address already exists. </p>';
				$stmt->close();
			}
		} else {
			$error_msg .= '<p class="error">Database error line 39</p>';
			$stmt->close();
		}

		if (empty($error_msg)) {
			// create hashed password
			$password = password_hash($password, PASSWORD_BCRYPT);

			// insert new user into db
			if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password) VALUES (?, ?, ?) ")) {
				$insert_stmt->bind_param('sss', $username, $email, $password);
				if (! $insert_stmt->execute()) {
					header('Location: ../error.php?err=REgistration failure: INSERT');
				}
			}
			header('Location: ./register_success.php');
		}
	}
?>