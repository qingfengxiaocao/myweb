
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
</html>
<?php
	//session_start();
	$chengjieshijian = date("Y-m-d H:i:s",time());
	$chengjierenemail = phpCAS::getUser();
	$id = $_GET["id"];
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	$sql1 ="select suoshurenwuid from zuoye where id ='$id'";
	$r = mysqli_query($coon, $sql1);
	$row = mysqli_fetch_object($r);
	$renwuid = $row->suoshurenwuid;
	$sql2 = "select yonghuemail from renwu where id='$renwuid'";
	$r1 = mysqli_query($coon, $sql2);
	$row1 = mysqli_fetch_object($r1);
	if(isset($chengjierenemail))
	{
		if($chengjierenemail==$row1->yonghuemail)
			echo "<script>alert('你不能接受自己的任务');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
		else{
			$sql = "update zuoye set chengjieshijian='$chengjieshijian',chengjierenemail='$chengjierenemail' where id='$id'";
			if(!(mysqli_query($coon, $sql))) 
				echo "<script>alert('接受作业失败');</script>";
			else
			{
				$renwuzhuangtaisql = "update renwu set renwuzhuangtai=1 where id='$renwuid'";
				mysqli_query($coon, $renwuzhuangtaisql);
				echo "<script>alert('接受作业成功！');window.location.href='../renwuGUI.php?id=$renwuid'</script>";			
			}
		}
	}
	else
		echo "<script>alert('请先登陆');window.location.href='../login.php'</script>";
?>