<?php
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	$key = $_POST["key"];
	$email = $_POST['email'];
	$sql = "select jifenyue from user where email='$email'";
	if($key == 'yuan')
	{
		$row = mysqli_query($coon, $sql);
		$obj = mysqli_fetch_object($row);
		echo $obj->jifenyue;
	}
?>