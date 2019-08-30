
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>

	<head>
		<meta charset="utf-8">
		<title>课程共建平台</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="titlepic.ico">
	</head>

	<body>
		<div class="container-fluid" style="min-width: 1080px;">
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<a href='index.php'>
						<h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
				<div class="col-xs-4 col-xs-offset-5">
					<?php
			  			//session_start();  			
			  			if(phpCAS::checkAuthentication())
			  			{
			  				echo '<span style="color:rgb(255,255,255)">'.phpCAS::getUser().'</span>&nbsp;&nbsp&nbsp;&nbsp';
			  				echo '&nbsp;&nbsp;&nbsp;<a href="index.php" style="color: rgb(255,255,255);line-height: 38px;">返回首页</a>';
			  				echo '&nbsp;&nbsp;&nbsp;<a href="pcenter.php" style="color: rgb(255,255,255);line-height: 38px;">个人中心</a>';
							echo '&nbsp;&nbsp;&nbsp;<a href="http://2001:da8:270:2021::62:8080/portal" style="color: rgb(255,255,255);line-height: 38px;">Sakai</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="?logout='.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'" style="color: rgb(255,255,255)"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出</a>';
					  		
			  			}
			  			else{
					  		echo '<a href="login.php" style="color: rgb(255,255,255);line-height: 38px;">登陆</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="registe.php" style="color: rgb(255,255,255)">注册</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="index.php" style="color: rgb(255,255,255);line-height: 38px;">返回首页</a>';
				  		}				  		
			  		?>
				</div>
			</div>
			<br />
			<div class="row">
				<br />
				<div class='col-md-8 col-md-offset-2' style='font-size:13px;color:	#101010'>
					<table class='table table-hover '>
						<thead>
							<tr class='active' style='color:#101010'>
								<th>#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>email</th>
								<th>college</th>
								<th>score</th>
								<th>查看小花园</th>
							</tr>
						</thead>
						<tbody>
					<?php
						$coon = mysqli_connect("localhost", "root","123456");
						mysqli_select_db($coon, "web");
						mysqli_set_charset($coon, "utf8");
						$sql = "select email,college,jifenyue from user order by jifenyue desc";
						$r = mysqli_query($coon, $sql);
						if($r)
						{
							while ($array = mysqli_fetch_object($r)) {
								$result[] = $array;
							}
							mysqli_close($coon);
						}
						$count = 1;
						foreach($result as $number=>$result)
						{
							echo "
								<td>{$count}</td>
								<td>{$result->email}</td>
								<td>{$result->college}</td>
								<td>{$result->jifenyue}</td>
								<td><a href=score.php?key=yuan&email=";
							echo $result->email;
							echo ">查看小花园</a></td>
							</tr>";
							$count = $count + 1;							
					}
					?>
						</tbody>
					</table>
					</div>
			</div>
		</div>
	</body>
	