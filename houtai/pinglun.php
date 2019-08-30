
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
	//session_start();
	$email = phpCAS::getUser();
	$renwuid = $_GET["renwuid"];
	$suoshuzuoyeid = $_GET["zuoyeid"];
	$plneirong=$_POST['plneirong'];
	
	
	date_default_timezone_set('PRC');
ini_set('memory_limit', '600M');

require_once "../nlp/vendor/multi-array/MultiArray.php";
require_once "../nlp/vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "../nlp/class/Jieba.php";
require_once "../nlp/class/Finalseg.php";
require_once "../nlp/class/JiebaAnalyse.php";
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\JiebaAnalyse;
Jieba::init(array('mode'=>'test','dict'=>'small'));
Finalseg::init();
JiebaAnalyse::init();
	
	$top_k = 3;
                            //$content = file_get_contents("/path/to/your/dict/lyric.txt", "r");
                            $tags = JiebaAnalyse::extractTags($_POST['plneirong'], $top_k);
                           // var_dump($tags);
							
							$tag=implode(", ",array_keys($tags));// var_dump($tag);
	
	$tijiaoshijian = date("Y-m-d H:i:s",time());
	$sql = "insert into pinglun(email,neirong,tag,tijiaoshijian,suoshuzuoyeid) values('$email','$plneirong','$tag','$tijiaoshijian','$suoshuzuoyeid')";
	if(!(mysqli_query($coon, $sql))) 
		echo "<script>alert('评论失败');</script>";
	else
		echo "<script>alert('评论成功');window.location.href='../renwuGUI.php?id=$renwuid'</script>";
						
?>