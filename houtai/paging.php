<?php
 
//分页的函数
function news($pageNum =1, $pageSize,$fx)
{
	$array = array();
    $coon = mysqli_connect("localhost", "root","123456");
    mysqli_select_db($coon, "web");
    mysqli_set_charset($coon, "utf8");
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
	if($fx == '')
		$rs = "select id,zhuti,fangxiangming,yonghuemail,chuangjianshijian,renwuzhuangtai from renwu order by chuangjianshijian desc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    else
    	$rs = "select id,zhuti,fangxiangming,yonghuemail,chuangjianshijian,renwuzhuangtai from renwu where fangxiangming={$fx} order by chuangjianshijian limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon);
    return $array;
}
 
//显示总页数的函数
function allNews($fx)
{
    $coon = mysqli_connect("localhost", "root","123456");
    mysqli_select_db($coon, "web");
    mysqli_set_charset($coon, "utf8");
    if($fx == '')
    	$rs = "select count(*) num from renwu"; //可以显示出总页数
    else
    	$rs = "select count(*) num from renwu where fangxiangming = {$fx}"; //可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    mysqli_close($coon);
    return $obj->num;
}
 
    @$allNum = allNews($_GET["fx"]);
    @$pageSize = 10; //约定没页显示几条信息
    @$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
    @$endPage = ceil($allNum/$pageSize); //总页数
    @$fx = $_GET["fx"];
    @$array = news($pageNum,$pageSize,$fx);
    ?>

