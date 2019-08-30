
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
</html>
<?php
	//session_start();
	$email = phpCAS::getUser();
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	if(!empty($_FILES['touxiang']['tmp_name']))
	{
		move_uploaded_file($_FILES['touxiang']['tmp_name'], "../../upfile/touxiang/{$email}.png");
		$touxiang = "upfile/touxiang/{$email}.png";
		$sql ="update user set touxiang='$touxiang' where email='$email'";
		mysqli_query($coon, $sql);
		echo "<script>alert('上传成功！');window.location.href='../../pcenter.php'</script>";
	}
	else
		echo "<script>alert('上传栏不能为空');window.location.href='../../pcenter.php'</script>";
?>