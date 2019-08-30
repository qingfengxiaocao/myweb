
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
	$zuoyeid = $_GET["zuoyeid"];
	$tijiaoshijian=date("Y-m-d-H-i-s",time());
	$sql1 ="select suoshurenwuid from zuoye where id='$zuoyeid'";
	$r = mysqli_query($coon, $sql1);
	$row = mysqli_fetch_object($r);
	$renwuid = $row->suoshurenwuid;
	if(!empty($_FILES['zyfujian']['tmp_name']))
	{
		$name = $_FILES["zyfujian"]["name"];
		move_uploaded_file($_FILES['zyfujian']['tmp_name'], "../upfile/zuoye/{$tijiaoshijian}");
		$fujian = "upfile/zuoye/{$tijiaoshijian}";
		$sql ="update zuoye set fujian='$fujian',tijiaoshijian='$tijiaoshijian',fujianming='$name' where id='$zuoyeid'";
		mysqli_query($coon, $sql);
		echo "<script>alert('上传成功！');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
	}
	else
		echo "<script>alert('上传栏不能为空');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
?>