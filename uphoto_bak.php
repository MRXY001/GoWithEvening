<?php

$name = $_FILES["img"]["name"];
$userID = $_REQUEST["userID"];

if (strlen($name) < 1) { echo "<script>alert('图片不能为空');history.go(-1);</script>";
	exit();
};

if (!empty($_FILES["img"]["name"])) {//提取文件域内容名称，并判断
	$path = "photo/";
	//上传路径
	/*if (!file_exists($path)) {
		//检查是否有该文件夹，如果没有就创建，并给予最高权限
		mkdir("$path", 0700);
	}*/
	//允许上传的文件格式
	/*$tp = array("image/gif", "image/pjpeg", "image/jpeg", "image/png");
	//检查上传文件是否在允许上传的类型
	if (!in_array($_FILES["img"]["type"], $tp)) {
		echo "格式不对";
		exit ;
	}//END IF*/
	/*$filetype = $_FILES['img']['type'];
	if ($filetype == 'image/jpeg') {
		$type = '.jpg';
	} else if ($filetype == 'image/jpg') {
		$type = '.jpg';
	} else if ($filetype == 'image/pjpeg') {
		$type = '.jpg';
	} else if ($filetype == 'image/gif') {
		$type = '.gif';
	} else if ($filetype == 'image/png') {
		$type = '.png';
	} else {
		$type = '.png';

	}*/
	/*$array = explode('.', $name);
	if (count($array) > 1) {
		$type = "." . $array[count($array) - 1];
	} else {
		$type = "";
	}*/

	/*if ($_FILES["img"]["name"]) {
		$today = date("YmdHis");
		//获取时间并赋值给变量
		$file2 = $path . $today . $type;
		//图片的完整路径
		$img = $today . $type;
		//图片名称
		$flag = 1;
	}*/
	$result = move_uploaded_file($_FILES["img"]["tmp_name"], $path . $userID . ".jpg");
	/*if ($flag)
		$result = move_uploaded_file($_FILES["img"]["tmp_name"], $file2);*/
	//特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
	//echo "上传成功|" . $file2;
	//exit;
	echo "OK";
}//END IF
?>