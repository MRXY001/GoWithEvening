<?php
	require "public_module.php";
	$photoname = seize0("photoname");

	$name = $_FILES["img"]["name"];
	
	if (strlen($name) < 1) { echo "<script>alert('图片不能为空');history.go(-1);</script>";
		exit();
	};
	
	if (!empty($_FILES["img"]["name"])) {//提取文件域内容名称，并判断
		$path = "photo/";
		
		$result = move_uploaded_file($_FILES["img"]["tmp_name"], $path . $photoname);
		
		echo "OK";
	}
?>