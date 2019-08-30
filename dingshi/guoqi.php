<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
</html>
<?php
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	$dangqianshijian = date("Y-m-d H:i:s",time());
	$sql ="update renwu set renwuzhuangtai=3 where jiezhishijian <= sysdate()";
	$row = mysqli_query($coon, $sql);
	echo $row;
?>