
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
	//session_start();
	$email = phpCAS::getUser();
	$xingming=$_POST['xiugaixingming'];
	if(isset($xingming))
	{
		$sql = "update user set name ='$xingming' where email='$email'";
		mysqli_query($coon, $sql);
		echo "<script>alert('修改成功');window.location.href='../../pcenter.php'</script>";
	}						
?>