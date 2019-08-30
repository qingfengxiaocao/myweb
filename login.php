
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<title>登陆界面</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="titlepic.ico">
		<script src="js/jquery-2.1.1.js"></script>
	</head>
	
	<body>
		<div class="container-fluid" style="min-width: 1080px;>
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<h4 style="color: rgb(255,255,255);">滁州学院</h4>
				</div>
			</div>
			<br />
			<br />
			<div style="text-align: center;height: 150px;">
				<h1>课程平台登陆</h1>
			</div>
			<div class="row">
				<div class="col-xs-4 col-xs-offset-4">
					<form method="post" action="login.php">
						<div class="form-group">
							<label for="exampleInputEmail1">账号(Email)</label>
							<input type="text" class="form-control" name="user" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">密码</label>
							<input type="password" class="form-control" name="pass" placeholder="Password">
						</div>
						<div class="checkbox">
							<label>
					      <input type="checkbox">记住密码
					    </label>
						</div>
						<button type="submit" class="btn btn-default">提交</button>
						<button type="button" class="btn btn-default" onclick="window.location.href='registe.php'">注册</button>
					</form>
					<?php					
						if(isset($_POST["user"]) && isset($_POST["pass"])){
									$user=$_POST["user"];
									$pass=md5($_POST["pass"]);
									$coon = mysqli_connect("localhost", "root","123456");
									mysqli_select_db($coon, "web");
									mysqli_set_charset($coon, "utf8");
									$sql = "select count(*) c from user where email='$user' and password='$pass'"; 
									$r = mysqli_query($coon, $sql);
									$row = mysqli_fetch_object($r);
									if($row->c > 0){
										//session_start();
								    	phpCAS::getUser() = $user;
								    	header("Location: index.php");
									}						
									else{					    	
										echo "<script>alert('用户名密码错误');</script>";
									}
													    				    
									mysqli_close($coon);
						}		
					?>			
				</div>
			</div>
		</div>
	</body>
</html>