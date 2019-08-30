
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
			  			//echo phpCAS::checkAuthentication() 	;
						//echo phpCAS::getUser();
						//return false;
			  			if(phpCAS::checkAuthentication())
			  			{   
			  				echo '<span style="color:rgb(255,255,255)">'.phpCAS::getUser().'</span>&nbsp;&nbsp&nbsp;&nbsp';
			  				echo '&nbsp;&nbsp;&nbsp;<a href="scoreboard.php" style="color: rgb(255,255,255);line-height: 38px;">排行榜</a>';
			  				echo '&nbsp;&nbsp;&nbsp;<a href="pcenter.php" style="color: rgb(255,255,255);line-height: 38px;">个人中心</a>';
							echo '&nbsp;&nbsp;&nbsp;<a href="http://2001:da8:270:2021::62:8080/portal" style="color: rgb(255,255,255);line-height: 38px;">Sakai</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="?logout='.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'" style="color: rgb(255,255,255)"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 退出</a>';
					  		
			  			}
			  			else{
					  		echo '<a href="login.php" style="color: rgb(255,255,255);line-height: 38px;">登陆</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="registe.php" style="color: rgb(255,255,255)">注册</a>';
					  		echo '&nbsp;&nbsp;&nbsp;<a href="scoreboard.php" style="color: rgb(255,255,255);line-height: 38px;">排行榜</a>';
				  		}
			  		?>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-xs-3 col-xs-offset-1">
					<img src="img/chzu.png" height="120" width="180" />
				</div>
				<h1 class="col-xs-3 col-xs-offset-1">课程共建平台</h1>
				<div class="col-xs-3 ">
					<br />
					<br />

				</div>
			</div>
			<!--
        	以上为头部,以下为主内容
        -->
			<div class="row">
				<div class="col-xs-2 col-xs-offset-1">
					<nav role="navigation">
						<div>
							<ul class="nav metismenu" id="side-menu">
								<li class="nav-header">
									<div class="dropdown profile-element">
										<h3 class="text-left" style="color:darkcyan">任务类别</h3>

									</div>
								</li>
								<br />
								<li class="active">
									<a href="?pageNum=1">
										<i class="fa fa-th-large"></i>
										<span class="nav-label">全部任务</span>
									</a>
								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='计算机信息'">
										<i class="fa fa-pie-chart"></i>
										<span class="nav-label">计算机信息类</span>
									</a>
								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='数学与金融'">
										<i class="fa fa-tag"></i>
										<span class="nav-label">数学与金融类</span>
									</a>

								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='机械与汽车'">
										<i class="fa fa-cube"></i>
										<span class="nav-label">机械与汽车类</span>
									</a>
								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='电子与电气'">
										<i class="fa fa-link"></i>
										<span class="nav-label">电子与电气类</span>
									</a>
								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='生物与食品'">
										<i class="fa fa-flask"></i>
										<span class="nav-label">生物与食品类</span>
									</a>
								</li>
								<br />
								<li>
									<a href="?pageNum=1&fx='材料与化学'">
										<i class="fa fa-info-circle"></i>
										<span class="nav-label">材料与化学类</span>
									</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="col-xs-8">
					<ul class="nav nav-pills">
						<li role="presentation">
							<a href="newtask.php">
								<h4>发布新任务</h4></a>
						</li>
					</ul>
					<br />
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
					    			include 'houtai/paging.php';
					    			if(empty($array)==false)
					    			{
						    			foreach($array as $key=>$values)
								    	{							    			
								    		echo "<tr>";								    	
								    		echo "<td><a href='renwuGUI.php?id=$values->id'>{$values->zhuti}";
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
							<ul class="pagination">
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
	</body>

</html>