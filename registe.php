<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册界面</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="titlepic.ico">
		<script src="js/jquery-2.1.1.js"></script>
	</head>
	
	<body>
		<div class="container-fluid" style="min-width: 1080px;>
			<div class="row mydiv">
				<div class="col-md-2 col-md-offset-1">
					<a href='index.php'><h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
			</div>
			<br />
			<br />
			<div style="text-align: center;height: 150px;">
				<h1>平台账号注册</h1>
			</div>			
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form method="post" action="houtai/myregiste.php">
						<div class="form-group">
							<label for="exampleInputEmail1">账号(Email)</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">密码</label>
							<input type="password" class="form-control" name="pass1" placeholder="Password" value="">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">确认密码</label>
							<input type="password" class="form-control" name="pass2" placeholder="Password" value="">
						</div>
						<div class="form-group">
							<label >姓名</label>
							<input type="text" class="form-control" name="name" placeholder="Name" value="">
						</div>
						<div class="form-group">
							<label >性别</label>
							<br />
							<label class="radio-inline">
							  <input type="radio" name="sex" id="Radio1" value="1"> 男
							</label>
							<label class="radio-inline">
							  <input type="radio" name="sex" id="Radio2" value="0"> 女
							</label>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">学校(必填)</label>
							<input type="text" class="form-control" name="college" placeholder="School" value="">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">工号</label>
							<input type="text" class="form-control" name="gonghao" placeholder="Number" value="">
						</div>						
						<div class="form-group">
							<label for="exampleInputPassword1">专业方向(必选)</label>
							<select class="form-control" name="fangxiang">							
								<option value="计算机信息">计算机信息</option>
								<option value="数学与金融">数学与金融</option>
								<option value="机械与汽车">机械与汽车</option>
								<option value="电子与电气">电子与电气</option>
								<option value="生物与食品">生物与食品</option>
								<option value="材料与化学">材料与化学</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">擅长课程(选填)</label>
							<input type="text" class="form-control" name="course" placeholder="Course" value="">
						</div>
						<button type="submit" class="btn btn-default">提交</button>
					</form>						
				</div>
			</div>
		</div>
	</body>
</html>