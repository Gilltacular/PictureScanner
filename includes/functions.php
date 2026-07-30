<?php
	include_once 'psl-config.php';

	function sec_session_start() {
		$session_name = 'sec_session_id';	// set custom session name
		session_name($session_name); 		// set a session name

		// Stops JavaScript being able to access the session id.
    	$secure = FALSE;   // Set to TRUE in production with HTTPS
		// Force sessions to only use cookies.
		$httponly = true;

		if (ini_set('session.use_only_cookies', 1) === FALSE) {
			header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
			exit();
		}
		// Gets current cookies params.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"],
			$cookieParams["path"],
			$cookieParams["domain"],
			$secure,
			$httponly);

		session_start();				// start session
		session_regenerate_id(true);	// don't keep old session data
	}

	function login($email, $password, $mysqli) {
		// protect against SQL injection by utilizing prepared statements
		if ($stmt = $mysqli->prepare("SELECT id, username, password FROM members WHERE email = ? LIMIT 1")) {
			$stmt->bind_param('s', $email);		// bind email to parameter
			$stmt->execute();					// execute prepared query
			$stmt->store_result();

			// get variables from result output
			$stmt->bind_result($user_id, $username, $db_password);
			$stmt->fetch();

			if ($stmt->num_rows==1) {
				//if user, check if account locked
				if (checkbrute($user_id, $mysqli) ==true) {
					// account locked
					// error page presents
					return false;
				} else {
					// Check if password matches
					if (password_verify($password, $db_password)) {
						// password is correct
						// get user-agent string of the user
						$user_browser = $_SERVER['HTTP_USER_AGENT'];
						// XSS protection to avoid printing the values
						$user_id = preg_replace("/[^0-9]+/", "", $user_id);
						$_SESSION['user_id'] = $user_id;
						// XSS protection to avoid printing the value
						$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
						$_SESSION['username'] = $username;
						$_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
						// login has completed successfully at this point
						return true;
					} else {
						// password incorrect
						// record login attempt
						$now = time();
						$mysqli->query("INSERT INTO login_attempts(user_id, time) VALUES ('$user_id', '$now')");
						return false;
					}
				}
			} else {
				// user not in database
				return false;
			}
		}
	}

	function checkbrute($user_id, $mysqli) {
		// timestamp
		$now = time();

		// count all logins in the last five hours
		$valid_attempts = $now - (5 * 60 * 60);

		if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
			$stmt->bind_param('i', $user_id);

			$stmt->execute();
			$stmt->store_result();

			// count up to five failed login attempts
			if ($stmt->num_rows > 5) {
				return true;

			} else {
				return false;
			}
		}
	}

	function login_check($mysqli) {
		// check if all session variables are set
		if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {

			$user_id = $_SESSION['user_id'];
			$login_string = $_SESSION['login_string'];
			$username = $_SESSION['username'];

			// get user-agent string of the user
			$user_browser = $_SERVER['HTTP_USER_AGENT'];

			if ($stmt = $mysqli->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) {
				// bind "user_id" to parameter
				$stmt->bind_param('i', $user_id);
				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows == 1) {
					// if user, get variable from result
					$stmt->bind_result($password);
					$stmt->fetch();
					$login_check = hash('sha512', $password . $user_browser);

					if ($login_check == $login_string) {
						// login successful
						return true;
					} else {
						// login unsuccessful
						return false;
					}
				} else {
					// login unsuccessful
					return false;
				}
			} else {
				header("Location: ../error.php?err=Database error: cannot prepare statement");
				exit();
			}
		} else {
			// login unsuccessful
			return false;
		}
	}

	function esc_url($url) {

	    if ('' == $url) {
	        return $url;
	    }

	    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

	    $strip = array('%0d', '%0a', '%0D', '%0A');
	    $url = (string) $url;

	    $count = 1;
	    while ($count) {
	        $url = str_replace($strip, '', $url, $count);
	    }

	    $url = str_replace(';//', '://', $url);

	    $url = htmlentities($url);

	    $url = str_replace('&amp;', '&#038;', $url);
	    $url = str_replace("'", '&#039;', $url);

	    if ($url[0] !== '/') {
	        return '';
	    } else {
	        return $url;
	    }
	}

	function Upload($image, $folder){
			global $mysqli;

			$image = $_FILES['image']['name'];
			$folder = "uploads/";

			// Sanitize filename
			$image = preg_replace('/[^a-zA-Z0-9._-]/', '_', $image);

			move_uploaded_file($_FILES['image']['tmp_name'], $folder . $image);

			if ($stmt = $mysqli->prepare("INSERT INTO photos(image_name, image_path) VALUES(?, ?)")) {
					$stmt->bind_param('ss', $image, $folder);
					$stmt->execute();

					if($stmt->affected_rows > 0){
							echo "<br>Image uploaded";
					}else{
							echo "<br>Image not uploaded";
					}
					$stmt->close();
			}
	}

	function Display($image_name, $image_path){
			global $mysqli;

			$folder = "uploads/";

			if ($stmt = $mysqli->prepare("SELECT image_name, image_path FROM photos WHERE image_name = ? AND image_path = ?")) {
					$stmt->bind_param('ss', $image_name, $image_path);
					$stmt->execute();
					$result = $stmt->get_result();

					if($opendir = opendir($folder)){
							while(($file = readdir($opendir)) !== FALSE){
									if($file != "." && $file != ".."){
											$safe_file = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
											echo "<img src='uploads/" . $safe_file . "' id='myImg' class='img-responsive thumbnail' width='300' height='300'>";

											// The Modal
											echo "<div id='myModal' class='modal'>";
											echo "<span class='close' onclick=\"document.getElementById('myModal').style.display='none'\">&times;</span>";
											echo "<img class='modal-content' id='img01'>";
											echo "<div id='caption'></div>";
											echo "</div>";

											echo "<script>
													var modal = document.getElementById('myModal');
													var img = document.getElementById('myImg');
													var modalImg = document.getElementById('img01');
													var captionText = document.getElementById('caption');
													img.onclick = function(){
															modal.style.display = 'block';
															modalImg.src = this.src;
															captionText.innerHTML = this.alt;
													}
													var span = document.getElementsByClassName('close')[0];
													span.onclick = function() {
															modal.style.display = 'none';
													}
											</script>";
									}else{
											echo "Error: file could not be displayed";
									}
							}
					}
					$stmt->close();
			}
	}

	function IsChecked($chkname,$value)
	{
			if(!empty($_POST[$chkname]))
			{
					foreach($_POST[$chkname] as $chkval)
					{
							if($chkval == $value)
							{
									return true;
							}
					}
			}
			return false;
	}
?>
