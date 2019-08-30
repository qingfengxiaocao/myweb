
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
</html>

<?php
	function jifenyue($jifenemail)
	{
		$coon = mysqli_connect("localhost", "root","123456");
		mysqli_select_db($coon, "web");
		mysqli_set_charset($coon, "utf8");
		$email = $jifenemail;
		$sql = "select jifenyue from user where email='$email'";
		$r = mysqli_query($coon, $sql);
		$result = mysqli_fetch_object($r);
		return $result->jifenyue;
	}
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	//session_start();
	$email = phpCAS::getUser();
	
	$renwuid = $_GET["renwuid"];
	$suoshuzuoyeid = $_GET["zuoyeid"];
		$jianchasql= "select count(*) num from pingjia where intiativeemail='$email' and zuoyeid='$suoshuzuoyeid'";
		$jianchar = mysqli_query($coon, $jianchasql);
    	$jianchaobj = mysqli_fetch_object($jianchar);
    	if($jianchaobj->num !=0 )
    	{
    		echo "<script>alert('请勿重复评价');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
    		exit;
    	}
		
		$yonghusql = "select yonghuemail from renwu where id='$renwuid'";
		$yonghur = mysqli_query($coon, $yonghusql);
    	$yonghuobj = mysqli_fetch_object($yonghur);
	$yonghuemail = $yonghuobj->yonghuemail;
	$pingjiazhi=$_POST['pingjiazhi'];
	$pingjiashijian = date("Y-m-d H:i:s",time());
		$zuoyesql ="select chengjierenemail from zuoye where id='$suoshuzuoyeid'";
		$zuoyer = mysqli_query($coon, $zuoyesql);
    	$zuoyeobj = mysqli_fetch_object($zuoyer);
    $passiveemail = $zuoyeobj->chengjierenemail;
	if($email == $yonghuemail)
	{
			$chuangjianrensql = "update zuoye set chuangjianrenpingfen='$pingjiazhi' where id='$suoshuzuoyeid'";
			if(!(mysqli_query($coon, $chuangjianrensql))) 
				echo "<script>alert('评价失败');</script>";
			else
			{
				$yue = jifenyue($passiveemail)+$pingjiazhi;
				$jifensql = "insert into zhangben(email,jiaoyie,yue,jiaoyishijian,jiaoyiyuanyin) values('$passiveemail','+{$pingjiazhi}','$yue','$pingjiashijian','创建人评分')";
				$jifensql1 = "update user set jifenyue='$yue' where email='$passiveemail'";
				$jifensql2 = "insert into pingjia(passiveemail,intiativeemail,pingjiashijian,pingjiazhi,zuoyeid,zhonglei) values('$passiveemail','$email','$pingjiashijian','$pingjiazhi','$suoshuzuoyeid','1')";
				mysqli_query($coon, $jifensql);
				mysqli_query($coon, $jifensql1);
				mysqli_query($coon, $jifensql2);			
				echo "<script>alert('创建人打分成功');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
			}

	}
	else
	{
		
		$renwusql = "select count(*) num from zuoye where suoshurenwuid='$renwuid' and chengjierenemail='$email'";
		$r = mysqli_query($coon, $renwusql);
    	$obj = mysqli_fetch_object($r);
		if($obj->num != 0)
		{
			$sql = "insert into pingjia(passiveemail,intiativeemail,pingjiashijian,pingjiazhi,zuoyeid) values('$passiveemail','$email','$pingjiashijian','$pingjiazhi','$suoshuzuoyeid')";
			if(!(mysqli_query($coon, $sql))) 
				echo "<script>alert('评价失败');</script>";
			else
			{
				$pingjiazhim = $pingjiazhi/5;
				$yuem = jifenyue($passiveemail)+$pingjiazhim;
				$jifensqlm = "insert into zhangben(email,jiaoyie,yue,jiaoyishijian,jiaoyiyuanyin) values('$passiveemail','+{$pingjiazhim}','$yuem','$pingjiashijian','组内人评分')";
				$jifensql1m = "update user set jifenyue='$yuem' where email='$passiveemail'";
				mysqli_query($coon, $jifensqlm);
				mysqli_query($coon, $jifensql1m);
				echo "<script>alert('评价成功');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
			}
		}
		else
			echo "<script>alert('非任务组员禁止打分');</script>";
	}
	
						
?>