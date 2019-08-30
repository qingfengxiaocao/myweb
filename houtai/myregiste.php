
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
						if($_POST['username']!='')
							$email=$_POST['username'];
						else{
							echo '<script>alert("请输入eamil!");window.location.href="../registe.php"</script>';
							exit;
						}
						
						if($_POST['pass1']!=''){
							$pass1=$_POST['pass1'];
						}
						else{
							echo '<script>alert("请输入密码!");window.location.href="../registe.php"</script>';
							exit;
						}
						
						if($_POST['pass2']!='')
							$pass2=$_POST['pass2'];
						else{
							echo '<script>alert("请确认密码!");window.location.href="../registe.php"</script>';
							exit;
						}
						if($_POST['name']!='')
							$name=$_POST['name'];
						else{
							echo '<script>alert("请输入姓名!");window.location.href="../registe.php"</script>';
							exit;
						}	
						if($_POST['sex']!='')
							$sex=$_POST['sex'];
						else{
							echo '<script>alert("请选择性别!");window.location.href="../registe.php"</script>';
							exit;
						}
							
						if($_POST['college']!='')
							$college=$_POST['college'];
						else
							$college=NULL;
						
						if($_POST['gonghao']!='')
							$gonghao=$_POST['gonghao'];
						else{
							echo '<script>alert("请输入工号!");window.location.href="../registe.php"</script>';
							exit;
						}
							
						if($_POST['course']!='')
							$course=$_POST['course'];
						else
							$course='未知';
						
						if($pass1==$pass2)
							$pass=md5($pass1);
						else{
							echo '<script>alert("两次密码不一致!");window.location.href="../registe.php"</script>';
							exit;
						}	
						$fangxiang=$_POST['fangxiang'];
						$sql1 = "select count(*) c from user where email='$email'";
						$r = mysqli_query($coon, $sql1);
						$row = mysqli_fetch_object($r);
						if($row->c > 0){
							echo '<script>alert("该用户名已被注册!");window.location.href="../registe.php"</script>';
							exit;
						}													
						$sql2 = "insert into user(email,password,name,sex,college,gonghao,fangxiang,course) values('$email','$pass','$name','$sex','$college',$gonghao,'$fangxiang','$course')"; 
						if(!(mysqli_query($coon, $sql2))) 
							echo "<script>alert('注册失败');</script>";
						else
							echo "<script>alert('注册成功！去登陆');window.location.href='../login.php'</script>";
						
					?>		