<?php
	require "public_module.php";
	
	$start = seize("start"); // 开始的列表位置
	$kind = seize("kind"); // 团的种类
	
	$username = seize("username");
	$password = seize("password");
	
	// 检查用户
	$username = urldecode($username);
	$password = urldecode($password);
	$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	if ($row = row($sql))
		$userID = $row["userID"];
	else $userID = "";
	
//	if (!$start) $start = 0;
//	if (!$kind) $kind = "";
	
	$time = time(); // 当前时间戳，未过期的任务
	
	$sql = "SELECT * FROM tasks WHERE end_time > $time ";
	
	if ($kind) // 种类
	{
		$sql .= "AND kind = '$kind'";
	}
	
	$sql .= "ORDER BY end_time ";
	
	if ($start) // 任务的位置
	{
		$sql .= "LIMIT $start, 10";
	}
	else
	{
		$sql .= "LIMIT 0, 20";
	}
	
	die_if(!($result = query($sql)), "获取数据失败" . error());
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<task>";
			if ($userID && $row["userID"] == $userID)
				echo "<state>2</state>"; // 发布的
			else if ($userID && strpos($row["personnel"], "<pers>" . $userID . "</pers>") > 0)
				echo "<state>1</state>"; // 加入的
			else echo "<state>0</state>";
			echo "<taskID>" . $row["taskID"] . "</taskID>";
			echo "<name>" . $row["taskname"] . "</name>";
			echo "<realname>" . $row["realname"] . "</realname>";
			echo "<picture>" . urldecode($row["picture"]) . "</picture>";
			echo "<picture1>" . urldecode($row["picture1"]) . "</picture1>";
			echo "<picture2>" . urldecode($row["picture2"]) . "</picture2>";
			echo "<picture3>" . urldecode($row["picture3"]) . "</picture3>";
			echo "<picture4>" . urldecode($row["picture4"]) . "</picture4>";
			echo "<intro>" . $row["introduction"] . "</intro>";
			echo "<start>" . $row["start_time"] . "</start>";
			echo "<deadline>" . $row["end_time"] . "</deadline>";
			echo "<count>" . $row["headcount"] . "</count>";
			echo "<now>" . $row["nowcount"] . "</now>";
			echo "<place>" . $row["place"] . "</place>";
			echo "<longitude>" . $row["longitude"] . "</longitude>";
			echo "<latitude>" . $row["latitude"] . "</latitude>";
			echo "<personnel>" . IDToName($row["personnel"]) . "</personnel>";
			echo "<link>" . $row["link"] . "</link>";
		echo "</task>\n";
	}
	
	function IDToName($per)
	{
		$sql = "SELECT * from users";
		die_if(!($result = query($sql)), "replace failed " . error());
		while ($row = mysql_fetch_array($result))
		{
			$oldstr = "<pers>" . $row["userID"] . "</pers>";
			$newstr = "<pers>" . $row["name"] . "</pers>";
			$per = str_replace($oldstr, $newstr, $per);
		}
		return $per;
	}
?>