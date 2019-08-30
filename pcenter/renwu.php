<!DOCTYPE html><?php require_once 'loginCAS.php';?>
<html>
	<head>
		<meta charset="utf-8">
		<title>个人中心</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css">
		<link href="../css/style.css" rel="stylesheet" type="text/css">
		<link href="../css/jquery-ui.min.css" rel="stylesheet">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/mycss.css" rel="stylesheet">
		<link rel="shortcut icon" href="../titlepic.ico">
		<script type="text/javascript" src="../js/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/myjs.js"></script>
		<?php
			  			//session_start();
			  			if(!(phpCAS::checkAuthentication()))
			  			{			  				
							echo '<script>alert("请登陆账号!");window.location.href="../login.php"</script>';				  		
			  			}
			  			$coon = mysqli_connect("localhost", "root","123456");
						mysqli_select_db($coon, "web");
						mysqli_set_charset($coon, "utf8");$user=phpCAS::getUser();
			  			$yonghusql = "select name,fangxiang,course,college,gonghao,role,touxiang from user where email='{$user}'";
						$yonghur = mysqli_query($coon, $yonghusql);
				    	$yonghuobj = mysqli_fetch_object($yonghur);
		?>
	</head>
	<body>
		<div class="container-fluid" style="min-width: 1080px;">
			<div class="row mydiv">
				<div class="col-xs-2 col-xs-offset-1">
					<a href='../index.php'><h4 style="color: rgb(255,255,255);">滁州学院</h4></a>
				</div>
				<div class="col-xs-3 col-xs-offset-6" >
					<?php
			  			if(phpCAS::checkAuthentication())
			  			{
			  				echo '<span style="color:rgb(255,255,255)">'.phpCAS::getUser().'</span>&nbsp;&nbsp&nbsp;&nbsp';
			  				echo "<a href='../index.php' style='color: rgb(255,255,255);line-height: 38px;'><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> 返回首页 </a>";
					  		echo '&nbsp;&nbsp;&nbsp;<a href="?logout='.<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ; ?>.'" style="color: rgb(255,255,255)"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出</a>';
					  		
			  			}
			  			else{
					  		echo '<a href="../login.php" style="color: rgb(255,255,255);line-height: 38px;">登陆</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="../registe.php" style="color: rgb(255,255,255)">注册</a>';
				  		}
			  		?>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-xs-3">
					<ul>
						<li style="font-size: 22px;"><A class="hover" href="../pcenter.php">账号管理</A></li>
						<li><A href="../pcenter.php">个人信息</A></li>
						<li><A href="renwu.php">我的任务</A></li>
						<li><A href="zuoye.php">我的作业</A></li>
						<li><A href="jifen.php">积分明细</A></li>
						<li><A href="jiangpin.php">奖品兑换</A></li>
						<li><A href="#">团队生活</A></li>
					</ul>
				</div>
				<div class="col-xs-7" style="padding-top: 80px;">
					<div class="table-responsive">
					    <table class="table">
					    	<thead>
					    		<tr>
					    			<th>任务主题</th>
					    			<th>所属类别</th>
					    			<th>发布者</th>
					    			<th>创建时间</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		<?php
					    			//分页的函数
									function news($pageNum =1, $pageSize)
									{
										$array = array();
									    $coon = mysqli_connect("localhost", "root","123456");
									    mysqli_select_db($coon, "web");
									    mysqli_set_charset($coon, "utf8");
									    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
										$rs = "select id,zhuti,fangxiangming,yonghuemail,chuangjianshijian,renwuzhuangtai from renwu where yonghuemail='{phpCAS::getUser()}' order by chuangjianshijian desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
									    $r = mysqli_query($coon, $rs);
									    while ($obj = mysqli_fetch_object($r)) {
									        $array[] = $obj;
									    }
									    mysqli_close($coon);
									    return $array;
									}		
									//显示总页数的函数
									function allNews()
									{
									    $coon = mysqli_connect("localhost", "root","123456");
									    mysqli_select_db($coon, "web");
									    mysqli_set_charset($coon, "utf8");
									    $rs = "select count(*) num from renwu where yonghuemail='{phpCAS::getUser()}'"; //可以显示出总页数
									    $r = mysqli_query($coon, $rs);
									    $obj = mysqli_fetch_object($r);
									    mysqli_close($coon);
									    return $obj->num;
									}
									@$allNum = allNews();
								    @$pageSize = 10; //约定没页显示几条信息
								    @$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
								    @$endPage = ceil($allNum/$pageSize); //总页数
								    @$array = news($pageNum,$pageSize);
								    
								    
								    if(empty($array)==false)
					    			{
						    			foreach($array as $key=>$values)
								    	{							    			
								    		echo "<tr>";								    	
								    		echo "<td><a href='../renwuGUI.php?id=$values->id'>{$values->zhuti}";
								    		if($values->renwuzhuangtai==0)
								    			echo "<span style='color:green'>(未承接)</span></a></td>";
								    		if($values->renwuzhuangtai==1)
								    			echo "<span style='color:#FFC125'>(未完成)</span></a></td>";
								    		if($values->renwuzhuangtai==2)
								    			echo "<span>(已结束)</span></a></td>";
								    		if($values->renwuzhuangtai==3)
								    			echo "<span style='color:red'>(已过期)</span></a></td>";
								    		echo "<td>{$values->fangxiangming}</td>";
								    		echo "<td>{$values->yonghuemail}</td>";
								    		echo "<td>{$values->chuangjianshijian}</td>";
								    		echo "</tr>";
								    	}
								    }
								    else{
								    	echo "<tr>";
								    	echo "<td><h4>抱歉，暂无任务</h4></td>";
								    	echo "</tr>";	
								    	}		    			
					    		?>					    					    		
					    	</tbody>
					    </table>

					    	<nav aria-label="Page navigation" style="text-align: center;">
					    		<ul class="pagination" style="width: 60%;">
					    			<li>
					    				<a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>" aria-label="Previous">
					    					<span aria-hidden="true">&laquo;</span>
					    				</a>
					    			</li>
					    			<li>
					    				<a href="?pageNum=1">首页</a>
					    			</li>
					    			<li>
					    				<a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a>
					    			</li>
					    			<li>
					    				<a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a>
					    			</li>
					    			<li>
					    				<a href="?pageNum=<?php echo $endPage?>">尾页</a>
					    			</li>
					    			<li>

					    			</li>
					    			<li>
					    				<a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>" aria-label="Next">
					    					<span aria-hidden="true">&raquo;</span>
					    				</a>
					    			</li>
					    		</ul>
					    	</nav>					
					</div>				
				</div>
			</div>		
		</div>
		<br  />
		<br  />
		<br  />
		<br  />
		
	</body>
</html>