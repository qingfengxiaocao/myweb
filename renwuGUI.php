
<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>

	<head>
		<?php
			//session_start();
			$denglumei = 0;
			if(phpCAS::checkAuthentication())
				$denglumei = 1;
			$id=$_GET["id"];
			if(!(isset($_GET["id"])))
			{
				header("location:index.php");
				exit;
			}
			$coon = mysqli_connect("localhost", "root","123456");
		    mysqli_select_db($coon, "web");
		    mysqli_set_charset($coon, "utf8");
		    $sql1="select yonghuemail,zhuti,neirong,tag,fangxiangming,chuangjianshijian,jiezhishijian,fujian,renwuzhuangtai,fujianming from renwu where id='$id'";
		    $r = mysqli_query($coon, $sql1);
			$row = mysqli_fetch_object($r);
			$yonghuemail=$row->yonghuemail;								/*从此开始时任务变量*/
			$zhuti=$row->zhuti;                            				 
			$neirong=$row->neirong;$tag=$row->tag;
			$fangxiangming=$row->fangxiangming;
			$chuangjianshijian=$row->chuangjianshijian;
			$jiezhishijian=$row->jiezhishijian;
			$fujian=$row->fujian;
			$fujianname=$row->fujianming;
			$renwuzhuangtai=$row->renwuzhuangtai;           			 //任务变量结束
			$sql2 = "select fangxiang,course,touxiang,jifenyue from user where email='$yonghuemail'";
			$r1 = mysqli_query($coon, $sql2);                          
			$result = mysqli_fetch_object($r1);
			$userfangxiang = $result->fangxiang;						//从此开始为用户变量
			$course = $result->course;
			$sql3 = "select chengjierenemail,id,zuoyeneirong,fujian,tijiaoshijian,zan,cai,fujianming from zuoye where suoshurenwuid='$id'";                      
			$r2	= mysqli_query($coon, $sql3);
			while($obj = mysqli_fetch_object($r2))
				$array[] = $obj; 									//作业内容数组			    			
		?>
			<meta charset="utf-8">
			<title>课程共建平台</title>
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/mycss.css" rel="stylesheet">
			<link href="css/jquery-ui.min.css" rel="stylesheet">
			<link rel="shortcut icon" href="titlepic.ico">
			<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
			<script type="text/javascript" src="js/jquery-ui.min.js"></script>
			<script type="text/javascript" src="js/myjs.js"></script>
	</head>

	<body>
		<div class="container-fluid" style="min-width: 1080px;">
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<a href='index.php'>
						<h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
				<div class="col-xs-3 col-xs-offset-6">
					<?php
			  			if(phpCAS::checkAuthentication())
			  			{
			  				echo '<span style="color:rgb(255,255,255)">'.phpCAS::getUser().'</span>&nbsp;&nbsp&nbsp;&nbsp';
			  				echo '<a href="pcenter.php" style="color: rgb(255,255,255);line-height: 38px;">个人中心</a>';
							echo '&nbsp;&nbsp;&nbsp;<a href="http://2001:da8:270:2021::62:8080/portal" style="color: rgb(255,255,255);line-height: 38px;">Sakai</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="?logout='.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'" style="color: rgb(255,255,255)"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出</a>';
					  		
			  			}
			  			else{
					  		echo '<a href="login.php" style="color: rgb(255,255,255);line-height: 38px;">登陆</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="registe.php" style="color: rgb(255,255,255)">注册</a>';
				  		}
			  		?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2 " id='zuobian'>
					<br />
					<br />
					<div style="position:absolute;top: 20%;padding-left: 55px;">
						<div style='text-align:center'>
							<img src="<?php echo $result->touxiang; ?>" style="width:98px;height:98px;" />
						</div>
						<br />
						<div style='text-align:center'>
							<?php 
								echo "<h5 style='text-align:center'>{$yonghuemail}</h5>";
								echo "<p>方向 : {$userfangxiang}</p>";
								echo "<p>擅长 : {$course}</p>";
								echo "<p>积分 : {$result->jifenyue}</p>";
							?>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-xs-offset-1" id="youbian">
					<br /><br />
					<div class="row">
						<div class="col-xs-2 col-xs-offset-10">
							<a href="index.php"><button type="button" class="btn btn-primary">返回任务列表</button></a>
						</div>
					</div>
					<div>
						<?php 
							if($renwuzhuangtai != 3)
								echo "<h3>{$zhuti}</h3>  <br> ";
							else
								echo "<h3>{$zhuti}<p style='color:red'>(已过期！)</p></h3><br>  ";
								echo "<h4 style='color:red'>NLP分析内容关键字:{$tag}</h4><br />";
							echo "<p style='font-size:18px'>任务内容:{$neirong}</p> <br />";
							echo "<h4 style='color:red'>任务截止时间:{$jiezhishijian}</h4><br />";
							echo "<span style='font-size:16px'>任务附件 : </span>";
							if($row->fujian=='NULL')
								echo "暂无";
							else
								echo "<a href={$fujian} download='{$fujianname}' style='font-size:15px'>{$fujianname}</a> ";
							
							echo "
								<div class='col-xs-5 col-xs-offset-7'>
									<p style='font-size:12px'>{$yonghuemail} 于 {$chuangjianshijian} </p>
									</div>
								</div>";
							echo "<hr style='border:1px dashed #000; height:1px'>";
							$count=1;
							if(isset($array))
							{
							foreach($array as $key=>$values)
							    	{
							    		$pinglunsql="select email,neirong,tag,tijiaoshijian from pinglun where suoshuzuoyeid='$values->id'";
							    		$pinglunr = mysqli_query($coon, $pinglunsql);                          
										while($pinglunobj = mysqli_fetch_object($pinglunr))
												$pinglunarray[] = $pinglunobj; 
							    		if($values->chengjierenemail==NULL)
							    		{
							    		echo "<h4>作业{$count}:<br>要求:  {$values->zuoyeneirong}</h4>";
							    		echo "<button type='button' class='btn btn-primary' onclick='dianji({$values->id});'>接受</button></a>";
							    		echo "<br />";
							    		echo "
													<div class='col-xs-2 col-xs-offset-10'>
														<a href='javascript:void(0)'><span onclick='huifu({$values->id},{$id},{$denglumei});'>回复</span></a>&nbsp;
														<a href='javascript:void(0)'><span onclick='dianzan({$values->id});' id='zan{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-up' aria-hidden='true'>{$values->zan}</span></a>
														<a href='javascript:void(0)'><span onclick='diancai({$values->id});' id='cai{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-down' aria-hidden='true'>{$values->cai}</span></a>
													</div><br>";
										if(isset($pinglunarray))
										{
											echo "<div class='row' style='min-width: 1380px;'>
														<div class='col-xs-1 '>
															<img src='img/3.png' style='height: 29px;width: 66px;'/>
														</div>
														<div class='col-xs-5'>
															<hr style='height:1px;border:none;border-top:1px solid #4398ed;margin-top:28px;margin-left:-51px;'/>
														</div>
													</div>";
											foreach($pinglunarray as $key=>$pinglunvalues)
							    			{	
							    				$shiyongzhesql = "select jifenyue,touxiang from user where email='$pinglunvalues->email'";
							    				$shiyongzher = mysqli_query($coon, $shiyongzhesql);                          
												$shiyongzheresult = mysqli_fetch_object($shiyongzher);									
												echo  "<div class='row' style='border-bottom:1px dashed #E0E0E0;padding:10px 0 11px;max-width:1380px;'>
														<div class='col-xs-1 '>
															<img src={$shiyongzheresult->touxiang} style='height: 42px;width: 42px;'/>
														</div>
														<div class='col-xs-11'>
															<div  class='row'>
																<div class='col-xs-4'>
																	<span style='font-size:11px'>{$pinglunvalues->email} | 积分：{$shiyongzheresult->jifenyue}</span>
																</div>
																<div class='col-xs-3 col-xs-offset-5' style='font-size:11px'>
																	{$pinglunvalues->tijiaoshijian}
																</div>
															</div>											
															<div class='row' style='padding-left:15px'>
																<div class='col-xs-10' style='color:red'>
																	NLP分析内容关键字:{$pinglunvalues->tag}
																</div>
																<div class='col-xs-10'>
																	{$pinglunvalues->neirong}
																</div>
															</div>
														</div>
													</div>";
											}
											$pinglunarray =null;
										}
							    		echo "<hr style='border:1px dashed #000; height:1px'>";
							    		echo "<br />";
							    												
										}
										else
										{
											if($values->fujian==NULL)
											{
												echo "<h4>作业{$count}:<br>要求:  {$values->zuoyeneirong}</h4><span style='color:red'>已接受:</span>[{$values->chengjierenemail}] ";								
												echo "<form method='post' action='houtai/zuoyefujian.php?zuoyeid={$values->id}' enctype='multipart/form-data'>						
													<div class='form-group'>
													    <input type='file' id='exampleInputFile' name='zyfujian'>
													    <p class='help-block'>请上传你的作业</p>
													</div>													
													<div class='form-group'>
														<button type='submit' class='btn btn-primary'>上传</button>
													</div>
													</form>";
												echo "
													<div class='col-xs-2 col-xs-offset-10'>
														<a href='javascript:void(0)'><span onclick='huifu({$values->id},{$id},{$denglumei});'>回复</span></a>&nbsp;
														<a href='javascript:void(0)'><span onclick='dianzan({$values->id});' id='zan{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-up' aria-hidden='true'>{$values->zan}</span></a>
														<a href='javascript:void(0)'><span onclick='diancai({$values->id});' id='cai{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-down' aria-hidden='true'>{$values->cai}</span></a>
													</div><br>";
												if(isset($pinglunarray))
												{
													echo "<div class='row' style='min-width: 1380px;'>
																<div class='col-xs-1 '>
																	<img src='img/3.png' style='height: 29px;width: 66px;'/>
																</div>
																<div class='col-xs-5'>
																	<hr style='height:1px;border:none;border-top:1px solid #4398ed;margin-top:28px;margin-left:-51px;'/>
																</div>
															</div>";
													foreach($pinglunarray as $key=>$pinglunvalues)
									    			{												
														$shiyongzhesql = "select jifenyue,touxiang from user where email='$pinglunvalues->email'";
									    				$shiyongzher = mysqli_query($coon, $shiyongzhesql);                          
														$shiyongzheresult = mysqli_fetch_object($shiyongzher);									
														echo  "<div class='row' style='border-bottom:1px dashed #E0E0E0;padding:10px 0 11px;max-width:1380px;'>
																<div class='col-xs-1 '>
																	<img src={$shiyongzheresult->touxiang} style='height: 42px;width: 42px;'/>
																</div>
																<div class='col-xs-11'>
																	<div  class='row'>
																		<div class='col-xs-4'>
																			<span style='font-size:11px'>{$pinglunvalues->email} | 积分：{$shiyongzheresult->jifenyue}</span>
																		</div>
																		<div class='col-xs-3 col-xs-offset-5' style='font-size:11px'>
																			{$pinglunvalues->tijiaoshijian}
																		</div>
																	</div>											
																	<div class='row' style='padding-left:15px'>\
																		<div class='col-xs-10' style='color:red'>
																	NLP分析内容关键字:{$pinglunvalues->tag}
																</div>
																		<div class='col-xs-10'>
																			{$pinglunvalues->neirong}
																		</div>
																	</div>
																</div>
															</div>";
													}
													$pinglunarray =null;
												}
											}
											else{
												echo "<h4>作业{$count}:<br>要求:  {$values->zuoyeneirong}</h4>于 {$values->tijiaoshijian} 被 {$values->chengjierenemail} <span style='color:red'>完成</span>";
												$sqlfujian="select fujian,fujianming from zuoye where id='$values->id'";
											    $rfujian = mysqli_query($coon, $sqlfujian);
												$rowfujian = mysqli_fetch_object($rfujian);
												$zuoyefujian=$rowfujian->fujian;
												$zuoyefujianname=$rowfujian->fujianming;
												echo "<br><br /><span>下载附件：</span>";
												echo "<a href={$zuoyefujian} download='{$zuoyefujianname}' style='font-size:15px'>{$zuoyefujianname}</a> ";
												echo "
													<div class='col-xs-2 col-xs-offset-10'>
														<a href='javascript:void(0)'><span onclick='pingjia({$values->id},{$id},{$denglumei});'>评价</span></a>&nbsp;
														<a href='javascript:void(0)'><span onclick='huifu({$values->id},{$id},{$denglumei});'>回复</span></a>&nbsp;
														<a href='javascript:void(0)'><span onclick='dianzan({$values->id});' id='zan{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-up' aria-hidden='true'>{$values->zan}</span></a>
														<a href='javascript:void(0)'><span onclick='diancai({$values->id});' id='cai{$values->id}' value='{$values->id}' class='glyphicon glyphicon-thumbs-down' aria-hidden='true'>{$values->cai}</span></a>
													</div> <br ><br><br>";
												if(isset($pinglunarray))
												{
													echo "<div class='row' style='min-width: 1380px;'>
																<div class='col-xs-1 '>
																	<img src='img/3.png' style='height: 29px;width: 66px;'/>
																</div>
																<div class='col-xs-5'>
																	<hr style='height:1px;border:none;border-top:1px solid #4398ed;margin-top:28px;margin-left:-51px;'/>
																</div>
															</div>";
													foreach($pinglunarray as $key=>$pinglunvalues)
									    			{												
														$shiyongzhesql = "select jifenyue,touxiang from user where email='$pinglunvalues->email'";
											    		$shiyongzher = mysqli_query($coon, $shiyongzhesql);                          
														$shiyongzheresult = mysqli_fetch_object($shiyongzher);									
														echo  "<div class='row' style='border-bottom:1px dashed #E0E0E0;padding:10px 0 11px;max-width:1380px;'>
																<div class='col-xs-1 '>
																	<img src={$shiyongzheresult->touxiang} style='height: 42px;width: 42px;'/>
																</div>
																<div class='col-xs-11'>
																	<div  class='row'>
																		<div class='col-xs-4'>
																			<span style='font-size:11px'>{$pinglunvalues->email} | 积分：{$shiyongzheresult->jifenyue}</span>
																		</div>
																		<div class='col-xs-3 col-xs-offset-5' style='font-size:11px'>
																			{$pinglunvalues->tijiaoshijian}
																		</div>
																	</div>											
																	<div class='row' style='padding-left:15px'>
																		<div class='col-xs-10' style='color:red'>
																	NLP分析内容关键字:{$pinglunvalues->tag}
																</div>
																		<div class='col-xs-10'>
																			{$pinglunvalues->neirong}
																		</div>
																	</div>
																</div>
															</div>";
													}
													$pinglunarray =null;
												}
											}
											echo "<hr style='border:1px dashed #000; height:1px'>";	
										}
										$count++;
							    	}
							   }
							   else{
							   	echo "<h4>暂无作业</h4>";
							   }	
							
					?>
					</div>
				</div>

				<div id="dialog" title="回复" style="display: none;">
					<form method="post" name="pinglunform">
						<div class="form-group">
							<label for="exampleInputPassword1">评论内容</label>
							<textarea class="form-control" rows="4" placeholder="输入评论内容" name="plneirong"></textarea>
						</div>

						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认发布</button>
						</div>
					</form>
				</div>
				<div id="pingjia" title="评价分数" style="display: none;">
					<form method="post" name="pingjiaform">
						<div class="form-group">
							<label for="exampleInputPassword1">评价分数</label>
							<input type="text" class="form-control" name="pingjiazhi" placeholder="请填入1-100">
						</div>
						<div class="form-group" style="text-align: center;">
							<button type="submit" class="btn btn-default">确认</button>
						</div>
					</form>
				</div>
				<script>
					function myfun() {
						var height = document.getElementById("youbian").offsetHeight;
						document.getElementById("zuobian").setAttribute('style', 'height: ' + height + 'px');
					}

					function dianji(id) {
						var msg = '您真的要接受本任务？\n请确认！';
						if(confirm(msg) == true) {
							window.location.href = 'houtai/zuoye.php?id=' + id;
						} else {
							return false;
						}
					}
					window.onload = myfun;
				</script>
	</body>

</html>