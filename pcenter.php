
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<title>个人中心</title>
		<link href="css/basic.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.min.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="titlepic.ico">
		<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/myjs.js"></script>
		<?php
			  		//	//session_start();
			  			if(!(phpCAS::checkAuthentication()))
			  			{			  				
							echo '<script>alert("请登陆账号!");window.location.href="login.php"</script>';				  		
			  			}
			  			$coon = mysqli_connect("localhost", "root","123456");
						mysqli_select_db($coon, "web");
						mysqli_set_charset($coon, "utf8");
						$user=phpCAS::getUser();
			  			$yonghusql = "select name,fangxiang,course,college,gonghao,role,touxiang,jifenyue from user where email='{$user}'";
						$yonghur = mysqli_query($coon, $yonghusql);
				    	$yonghuobj = mysqli_fetch_object($yonghur);
		?>
	</head>
	<body>
		<div class="container-fluid" style="min-width: 1080px;">
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<a href='index.php'><h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
				<div class="col-xs-3 col-xs-offset-6" >
					<?php
			  			if(phpCAS::checkAuthentication())
			  			{
			  				echo '<span style="color:rgb(255,255,255)">'.phpCAS::getUser().'</span>&nbsp;&nbsp&nbsp;&nbsp';
			  				echo "<a href='index.php' style='color: rgb(255,255,255);line-height: 38px;'><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> 返回首页 </a>";
					  		echo '&nbsp;&nbsp;&nbsp;<a href="?logout='.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'" style="color: rgb(255,255,255)"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出</a>';
					  		
			  			}
			  			else{
					  		echo '<a href="login.php" style="color: rgb(255,255,255);line-height: 38px;">登陆</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="registe.php" style="color: rgb(255,255,255)">注册</a>';
				  		}
			  		?>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-xs-3">
					<ul>
						<li style="font-size: 22px;"><A class="hover" href="pcenter.php">账号管理</A></li>
						<li><A href="pcenter.php">个人信息</A></li>
						<li><A href="pcenter/renwu.php">我的任务</A></li>
						<li><A href="pcenter/zuoye.php">我的作业</A></li>
						<li><A href="pcenter/jifen.php">积分明细</A></li>
						<li><A href="pcenter/jiangpin.php">奖品兑换</A></li>
						<li><A href="#">团队生活</A></li>
					</ul>
				</div>
				<div class="col-xs-7" style="padding-top: 80px;">
					<div style="border:1px solid #d0d0d0">
						<div style="background-color: #F3F3F4;color: #737373;">
							<p style="padding:7px 0px 7px 20px;">基本信息</p>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								姓名  								
							</div>
							<div class="col-xs-6">
								<?php
									echo $yonghuobj->name;
								?> 
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='xingming()'>修改</span></a>&nbsp;
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								工号  								
							</div>
							<div class="col-xs-6">
								<?php
									echo $yonghuobj->gonghao;
								?> 
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='gonghao()'>修改</span></a>&nbsp;
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								学校  								
							</div>
							<div class="col-xs-6">
								<?php
									echo $yonghuobj->college;
								?> 
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='xuexiao()'>修改</span></a>&nbsp;
							</div>
						</div>						
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								专业方向
							</div>
							<div class="col-xs-6">
								<?php
									echo $yonghuobj->fangxiang;
								?> 
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='fangxiang()'>修改</span></a>&nbsp;
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								擅长课程
							</div>
							<div class="col-xs-6">
								<?php
									echo $yonghuobj->course;
								?> 
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='kecheng()'>修改</span></a>&nbsp;
							</div>
						</div>
						<div style="background-color: #F3F3F4;color: #737373;">
							<p style="padding:7px 0px 7px 20px;">账号信息</p>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								积分余额
							</div>
							<div class="col-xs-4">
								<p>
									<?php
									echo $yonghuobj->jifenyue;
									?> 
								</p>
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								当前头像
							</div>
							<div class="col-xs-3">
								<p>预览：</p>
								<img  id="avarimgs" src="<?php echo $yonghuobj->touxiang; ?>" style="width:98px;height:98px;"/>
							</div>
							<div class="col-xs-4" style="padding-top: 30px;">
								<form method='post' action='houtai/xiugaixinxi/xiugaitouxiang.php' enctype='multipart/form-data'>
									<p class='help-block'>请上传你的头像</p>
									<input type='file' id='InputFile' name='touxiang' accept="image/*" onchange="xmTanUploadImg(this)">
									<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button type='submit' class='btn btn-primary'>确认更换</button>
								</form>
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								修改密码
							</div>
							<div class="col-xs-4">
								<a href='javascript:void(0)'><span onclick='mima()'>修改密码</span></a>&nbsp;
							</div>
						</div>
						<div class="row" style="padding:20px 0px 20px 40px;">
							<div class="col-xs-2">
								账号权限
							</div>
							<div class="col-xs-6">
								<?php
								 	if($yonghuobj->role == 1)
										echo '普通用户';
									if($yonghuobj->role == 0)
										echo '管理员';
								?> 
							</div>
						</div>
					</div>					
				</div>
			</div>		
		</div>
		<br  />
		<br  />
		<br  />
		<br  />
		
		
	
	<div id="xiugaixingming" title="修改信息" style="display: none;">
		  	<form method="post" name="xingmingform" >						
						<div class="form-group">
							<label for="exampleInputPassword1">修改姓名</label>
							<input type="text" class="form-control" name="xiugaixingming" placeholder="请填入姓名">
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	<div id="xiugaifangxiang" title="修改信息" style="display: none;">
		  	<form method="post" name="fangxiangform">						
						<div class="form-group">
							<label for="exampleInputPassword1">修改方向</label>
							<select class="form-control" name="xiugaifangxiang">							
								<option value="计算机信息">计算机信息</option>
								<option value="数学与金融">数学与金融</option>
								<option value="机械与汽车">机械与汽车</option>
								<option value="电子与电气">电子与电气</option>
								<option value="生物与食品">生物与食品</option>
								<option value="材料与化学">材料与化学</option>
							</select>
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	<div id="xiugaikecheng" title="修改信息" style="display: none;">
		  	<form method="post" name="kechengform">						
						<div class="form-group">
							<label for="exampleInputPassword1">修改擅长课程</label>
							<input type="text" class="form-control" name="xiugaikecheng" placeholder="请填入擅长课程">
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	<div id="xiugaigonghao" title="修改信息" style="display: none;">
		  	<form method="post" name="gonghaoform">						
						<div class="form-group">
							<label for="exampleInputPassword1">修改工号</label>
							<input type="text" class="form-control" name="xiugaigonghao" placeholder="请填入工号">
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	<div id="xiugaixuexiao" title="修改信息" style="display: none;">
		  	<form method="post" name="xuexiaoform">						
						<div class="form-group">
							<label for="exampleInputPassword1">修改学校</label>
							<input type="text" class="form-control" name="xiugaixuexiao" placeholder="请填入学校">
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	<div id="xiugaimima" title="修改信息" style="display: none;">
		  	<form method="post" name="mimaform">						
						<div class="form-group">
							<label for="exampleInputPassword1">输入新密码</label>
							<input type="text" class="form-control" name="xiugaimima1" placeholder="请填入新密码">
							<label for="exampleInputPassword1">再次输入密码</label>
							<input type="text" class="form-control" name="xiugaimima2" placeholder="请再次新密码">
						</div>						
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>	
	</div>
	</body>
</html>