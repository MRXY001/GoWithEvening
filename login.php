<?php
	require "public_module.php";
	
	$username = seize0("username");
	$password = seize0("password");
	
	$username = urldecode($username);
	$password = urldecode($password);
	
	$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	die_if (!($row = row($sql)), "Wrong");
	
	$realname = $row["name"];
	echo "<realname>" . $realname . "</realname>";
	echo "OK";
?>