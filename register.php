<?php
	require "public_module.php";
	
	$username = seize0("username");
	$password = seize0("password");
	$name = seize0("name");
	
	$username = urldecode($username);
	$password = urldecode($password);
	$name = urldecode($name);
	
	$sql = "SELECT * FROM users WHERE username = '$username'";
	die_if (row($sql), "Repeat");
	
	$userID = create_ID();
	
	$sql = "INSERT INTO users (userID, username, password, name) VALUES ('$userID', '$username', '$password', '$name')";
	
	die_if(!query($sql), "添加用户数据出错".error());
	
	echo "OK";
	
	function create_ID() // 生成独一无二的用户ID
	{
		$userID = 0;
		do{
			$userID = rand(10000000, 99999999);
			$sql = "select * from users where userID='$userID'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
		}while ($row);
		return $userID;
	}
?>