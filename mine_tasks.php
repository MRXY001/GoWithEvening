<?php
	require "public_module.php";
	
	$start = seize("start"); // 开始的列表位置
	$kind = seize("kind"); // 团的种类
	$username = seize0("username");
	$password = seize0("password");
	
	// 检查用户
	$username = urldecode($username);
	$password = urldecode($password);
	$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	die_if (!($row = row($sql)), "Account wrong");
	$userID = $row["userID"];
	$realname = $row["name"];
	
	
	// 未过期的任务
	
	$time = time(); // 当前时间戳，未过期的任务
	
	$sql = "SELECT * FROM tasks WHERE userID = '$userID' AND end_time > $time ";
//	$sql = "SELECT * FROM tasks WHERE userID = '$userID'";
	
	if ($kind) // 种类
	{
		$sql .= "AND kind = '$kind'";
	}
	
	$sql .= "ORDER BY end_time ";
	
	die_if(!($result = query($sql)), "获取数据失败" . error());
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<task>";
			echo "<state>2</state>"; // 发布的
			echo "<taskID>" . $row["taskID"] . "</taskID>";
			echo "<name>" . $row["taskname"] . "</name>";
			echo "<realname>" . $realname . "</realname>";
			echo "<picture>" . urldecode($row["picture"]) . "</picture>";
			echo "<picture1>" . urldecode($row["picture1"]) . "</picture1>";
			echo "<picture2>" . urldecode($row["picture2"]) . "</picture2>";
			echo "<picture3>" . urldecode($row["picture3"]) . "</picture3>";
			echo "<picture4>" . urldecode($row["picture4"]) . "</picture4>";
			echo "<intro>" . $row["introduction"] . "</intro>";
			echo "<start>" . $row["start_time"] . "</start>";
			echo "<deadline>" . $row["end_time"] . "</deadline>";
			echo "<count>" . $row["headcount"] . "</count>";
			echo "<now>" . $row["nowcount"] . "</count>";
			echo "<place>" . $row["place"] . "</place>";
			echo "<personnel>" . IDToName($row["personnel"]) . "</personnel>";
			echo "<link>" . $row["link"] . "</link>";
		echo "</task>\n";
	}


	// 已过期的任务
	
	$sql = "SELECT * FROM tasks WHERE userID = $userID AND end_time <= $time ";
	
	if ($kind) // 种类
	{
		$sql .= "AND kind = '$kind'";
	}
	
	$sql .= "ORDER BY end_time ";
	
	die_if(!($result = query($sql)), "获取数据失败" . error());
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<task>";
			echo "<state>2</state>"; // 发布的
			echo "<taskID>" . $row["taskID"] . "</taskID>";
			echo "<name>" . $row["taskname"] . "</name>";
			echo "<realname>" . $realname . "</realname>";
			echo "<picture>" . urldecode($row["picture"]) . "</picture>";
			echo "<picture1>" . urldecode($row["picture1"]) . "</picture1>";
			echo "<picture2>" . urldecode($row["picture2"]) . "</picture2>";
			echo "<picture3>" . urldecode($row["picture3"]) . "</picture3>";
			echo "<picture4>" . urldecode($row["picture4"]) . "</picture4>";
			echo "<intro>" . $row["introduction"] . "</intro>";
			echo "<start>" . $row["start_time"] . "</start>";
			echo "<deadline>" . $row["end_time"] . "</deadline>";
			echo "<count>" . $row["headcount"] . "</count>";
			echo "<now>" . $row["nowcount"] . "</count>";
			echo "<place>" . $row["place"] . "</place>";
			echo "<personnel>" . IDToName($row["personnel"]) . "</personnel>";
			echo "<link>" . $row["link"] . "</link>";
		echo "</task>\n";
	}
	
	function IDToName($per)
	{
		$sql = "SELECT * from users";
		$result = query($sql);
		while ($row = mysql_fetch_array($result))
		{
			$oldstr = "<pers>" . $row["userID"] . "</pers>";
			$newstr = "<pers>" . $row["name"] . "</pers>";
			$per = str_replace($oldstr, $newstr, $per);
		}
		return $per;
	}
?>