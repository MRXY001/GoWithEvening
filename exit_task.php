<?php
	require "public_module.php";
	
	$username = seize0("username");
	$password = seize0("password");
	$taskID = seize0("taskID");
	
	// 检查用户
	$username = urldecode($username);
	$password = urldecode($password);
	$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	die_if (!($row = row($sql)), "Account wrong");
	$userID = $row["userID"];
	
	$sql = "SELECT * FROM tasks WHERE taskID = '$taskID'";
	die_if(!($row = row($sql)), "Task not exit");
	
	$personnels = $row["personnel"];

	if (!strpos($personnels, "<pers>" . $userID . "</pers>")) // 没有加入，谈何退出
	{
		die("You haven't joined");
	}
	
	$nowcount = $row["nowcount"] - 1;
	$personnels = str_replace($personnels, "<pers>" . $userID . "</pers>", " ");
	
	$sql = "UPDATE tasks SET nowcount = '$nowcount', personnel = '$personnels' WHERE taskID = '$taskID'";
	die_if(!query($sql), "Exit False " . error());
	
	echo "OK";
?>