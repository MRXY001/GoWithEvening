<?php
	require "public_module.php";
	
	$username = seize0("username");
	$password = seize0("password");
	
	$taskname = urldecode(seize0("taskname"));
	$kind = seize0("kind");
	$introduction = urldecode(seize("introduction"));
	$endtime = seize("endtime");
	$headcount = seize0("headcount");
	$place = urldecode(seize("place"));
	$longitude = urldecode(seize("longitude"));
	$latitude = urldecode(seize("latitude"));
	$reqer = seize("reqer");
	$reqee = seize("reqee");
	$pic = (seize("pic"));
	$pic1 = (seize("pic1"));
	$pic2 = (seize("pic2"));
	$pic3 = (seize("pic3"));
	$pic4 = (seize("pic4"));
	
	if ($kind == "" || $kind == NULL)
		$kind = "self"; // 自助
	
	// 检查用户
	$username = urldecode($username);
	$password = urldecode($password);
	$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	die_if (!($row = row($sql)), "Account wrong");
	$userID = $row["userID"];
	$realname = $row["name"];
	
	$taskID = create_ID();
	$time = time();
	if (strpos($pic, "http") === NULL)
		$pic = urlencode("http://mmmmwxy.cn/tuan/photo/" . $taskID . ".jpg");
	if (strpos($pic1, "http") === NULL)
		$pic = urlencode("http://mmmmwxy.cn/tuan/photo/" . $taskID . "1.jpg");
	if (strpos($pic2, "http") === NULL)
		$pic = urlencode("http://mmmmwxy.cn/tuan/photo/" . $taskID . "2.jpg");
	if (strpos($pic3, "http") === NULL)
		$pic = urlencode("http://mmmmwxy.cn/tuan/photo/" . $taskID . "3.jpg");
	if (strpos($pic4, "http") === NULL)
		$pic = urlencode("http://mmmmwxy.cn/tuan/photo/" . $taskID . "4.jpg");
	
	/*if (strpos($pic, "http://") > 0 || && strpos($pic, "https://") > 0) // 网络图片
	{
		; 
	}*/
	
	$sql = "INSERT INTO tasks (taskID, userID, realname, taskname, kind, introduction, start_time, end_time, headcount, nowcount, place, longitude, latitude, employers_requirements, employees_requirements, picture, picture1, picture2, picture3, picture4)
					 VALUES ('$taskID', '$userID', '$realname', '$taskname', '$kind', '$introduction', '$time', '$endtime', '$headcount', 0, '$place', '$longitude', '$latitude', '$reqer', '$reqee', '$pic', '$pic1', '$pic2', '$pic3', '$pic4')";
	die_if(!query($sql), "添加任务失败".error());
	echo "OK";
	

	function create_ID() // 生成独一无二的任务ID
	{
		$taskID = 0;
		do{
			$taskID = rand(100000000, 999999999);
			$sql = "select * from tasks where userID='$taskID'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
		}while ($row);
		return $taskID;
	}
?>