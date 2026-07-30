<?php
	/**
	* Database Configuration
	* 
	* IMPORTANT: Copy this file to 'psl-config.php' and fill in your 
	* actual credentials. Never commit real credentials to version control.
	* See: config.example.php for the template.
	*/

	define ("HOST", getenv('DB_HOST') ?: "localhost");
	define("USER", getenv('DB_USER') ?: "your_db_user");
	define("PASSWORD", getenv('DB_PASSWORD') ?: "your_db_password");
	define("DATABASE", getenv('DB_NAME') ?: "pic_scanner");

	define("CAN_REGISTER", "any");
	define("DEFAULT_ROLE", "member");

	define("SECURE", TRUE); // Set to FALSE for local development only
?>
