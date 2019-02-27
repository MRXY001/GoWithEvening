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

	if (strpos($personnels, "<pers>" . $userID . "</pers>") > 0) // 已经加入了
	{
		die("Joined");
	}
	else if ($userID == $row["userID"])
	{
		die("Joined,emmmmmm");
	}
	
	die_if ($row["headcount"] <= $row["nowcount"], "Full"); // 人已经满了
	
	$nowcount = $row["nowcount"] + 1;
	if ($personnels == NULL) $personnels = "_";
	$personnels = $personnels . $nowcount . "<pers>" . $userID . "</pers>";
	
	$sql = "UPDATE tasks SET nowcount = '$nowcount', personnel = '$personnels' WHERE taskID = '$taskID'";
	die_if(!query($sql), "Join False " . error());
	

	echo "OK";
?>