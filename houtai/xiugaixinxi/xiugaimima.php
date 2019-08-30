
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
	$mima1=$_POST['xiugaimima1'];
	$mima2=$_POST['xiugaimima2'];
	if($mima1==$mima2)
		$pass=md5($mima1);
	else{
			echo '<script>alert("两次密码不一致!修改失败");window.location.href="../../pcenter.php"</script>';
			exit;
		}	
	$sql = "update user set password ='$pass' where email='$email'";
	mysqli_query($coon, $sql);
	echo "<script>alert('修改成功');window.location.href='../../pcenter.php'</script>";					
?>