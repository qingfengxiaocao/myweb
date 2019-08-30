<?php
	$coon = mysqli_connect("localhost", "root","123456");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	//session_start();
	$email = phpCAS::getUser();
	$zuoyeid = $_POST['id'];
	$result = $_POST['result'];
		$jianchasql ="select count(*) num from dianzan where dianzanemail='$email' and zuoyeid='$zuoyeid'";
		$jianchar = mysqli_query($coon, $jianchasql);
    	$jianchaobj = mysqli_fetch_object($jianchar);
    $insertsql = "insert into dianzan(dianzanemail,zuoyeid) values('$email','$zuoyeid')";
    $deletesql = "delete from dianzan where dianzanemail = '$email' and zuoyeid = '$zuoyeid' ";
    if($jianchaobj->num ==0 )
    {
		if($result == 'zan')
		{
			mysqli_query($coon, $insertsql);
			$sql="update zuoye set zan=zan+1 where id='$zuoyeid'";
			mysqli_query($coon, $sql);
			echo 1;
		}		
		if($result == 'cai')
		{
			mysqli_query($coon, $insertsql);
			$sql="update zuoye set cai=cai+1 where id='$zuoyeid'";
			mysqli_query($coon, $sql);
			echo 1;
		}		
	}
	if($result == 'nozan')
		{
			mysqli_query($coon, $deletesql);
			$sql="update zuoye set zan=zan-1 where id='$zuoyeid'";
			mysqli_query($coon, $sql);
			echo 1;
		}
	if($result == 'nocai')
		{
			mysqli_query($coon, $deletesql);
			$sql="update zuoye set cai=cai-1 where id='$zuoyeid'";
			mysqli_query($coon, $sql);
			echo 1;
		}	
?>