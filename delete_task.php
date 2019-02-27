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
	
	die_if($userID != $row["userID"], "Not Your task...");
	
	$pic = $row["picture"];
	$pic1 = $row["picture1"];
	$pic2 = $row["picture2"];
	$pic3 = $row["picture3"];
	$pic4 = $row["picture4"];
	delete_photo($pic);
	delete_photo($pic1);
	delete_photo($pic2);
	delete_photo($pic3);
	delete_photo($pic4);
		
	$sql = "DELETE from tasks WHERE taskID = '$taskID'";
	die_if(!query($sql), "Delete False " . error());

	echo "OK";
	
	
	function delete_photo($pic)
	{
		if (!$pic) return ;
		if (strpos($pic, "http") === NULL) return ;
		if (strpos($pic, "mmmmwxy") == NULL) return ;
		$pic = urldecode($pic);
		$pos = strrpos($pic, "/");
		$filename = substr($pic, $pos+1, strlen($pic)-$pos);
		$file = "photo/$filename";
		if (file_exists($file))
			unlink($file); 
	}
	
	
?>