
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<title>任务发布</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="titlepic.ico">
		<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<script src="js/jquery-2.1.1.js"></script>
		<script src="js/bootstrap.min.js"></script>	
		<script src="js/moment-with-locales.min.js"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script src="js/bootstrap-datetimepicker.zh-CN.js"></script>
		
		<?php
			  			////session_start();
						//print session_name();echo '<br>';
//print session_id();var_dump($_SESSION);
			  	if(!phpCAS::checkAuthentication())
			  			{			  				
							echo '<script>alert("请登陆账号!");window.location.href="?logout="</script>';				  		
			  			}
		?>
	</head>
	<body>
		<div class="container-fluid" style="min-width: 1080px;">
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<a href='index.php'><h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
				<div class="col-xs-2 col-xs-offset-7" >
					<a href="index.php" style="color: rgb(255,255,255);line-height: 38px;"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 返回首页</a>
					<a href="?logout=<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" style="color: rgb(255,255,255);line-height: 38px;"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出账号</a>
					
				</div>
			</div>
			<br />
			<br />
			<div style="text-align: center;height: 70px;">
				<h1>新任务发布</h1>
			</div>
			<div class="row">
				<div class="col-xs-4 col-xs-offset-4">
					<form method="post" action="houtai/mynewtask.php" enctype='multipart/form-data'>
						<div class="form-group">
							<label for="exampleInputEmail1">任务主题</label>
							<input type="text" class="form-control" name="zhuti" placeholder="主题">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">任务总体内容</label>
							<textarea class="form-control" rows="4" placeholder="请输入任务总体内容" name="neirong"></textarea>
						</div>
						<div class="form-group" id="div1">
							<button type="button" class="btn btn-primary" id='btn'>点击添加一个作业</button>(至少一个)<br>
						</div>
						<br />
						<div class="form-group">
							<label for="exampleInputPassword1">任务方向类型</label>
							<select class="form-control" name="fangxiang">							
								<option value="计算机信息">计算机信息</option>
								<option value="数学与金融">数学与金融</option>
								<option value="机械与汽车">机械与汽车</option>
								<option value="电子与电气">电子与电气</option>
								<option value="生物与食品">生物与食品</option>
								<option value="材料与化学">材料与化学</option>
							</select>
						</div>
						<br />						
						<div class="form-group">
							<label>选择截止日期：</label>
							<!--指定 date标记-->
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="jiezhishijian"/>
								<span class="input-group-addon">
						                    <span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<br />
						<div class="form-group">
						    <label for="exampleInputFile">附件上传</label>
						    <input type="file" id="exampleInputFile" name="fujian">
						    <p class="help-block">请上传你的课程附件</p>
						</div>
						<br />
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认发布</button>
							<a href="index.php"><button type="button" class="btn btn-default">取消</button></a>
						</div>
					</form>					
				</div>
			</div>
		</div>
		<script>		
			$(function () {
			    $('#datetimepicker2').datetimepicker({
			        language: 'zh-CN',//显示中文
			        format: 'yyyy-mm-dd hh:ii:ss',//显示格式
			        minView: "0",//设置只显示到月份
			        initialDate: new Date(),
			        autoclose: true,//选中自动关闭
			        todayBtn: true,//显示今日按钮
			        locale: moment.locale('zh-cn')
			    });
			});
			var i=1;
			document.getElementById('btn').addEventListener('click', function() {									
			var div =document.getElementById('div1');
			var htmlFragment = '作业'+i+'内容:';
			var addlabel=document.createElement('label');
			addlabel.innerHTML = htmlFragment;
			div.appendChild(addlabel);
			div.appendChild(document.createElement('br'));
			var addtextarea=document.createElement('textarea');
			addtextarea.className='form-control';
			addtextarea.rows='4';
			addtextarea.placeholder='请输入作业'+i+'内容';
			addtextarea.name='zuoye'+i;
			i++;
			div.appendChild(addtextarea);
			}, false);
		</script>	
	</body>	
	

	