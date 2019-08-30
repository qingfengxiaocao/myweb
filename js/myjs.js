var address = '127.0.0.1/bendiweb/myweb'             //请输入根目录地址
var count =-1
function dianzan(id)
{	
	zan = document.getElementById('zan'+id+'');
	zuoyeid = zan.getAttribute('value');
	if(count == -1)
	{				
		$.ajax({
			url: "http://"+address+"/houtai/dianzan.php",
			type: 'post',
			data: "id="+zuoyeid+"&result=zan",				
			async: true,
			success: function(data) {
				if(data==1){
					alert('点赞成功');
					zan.innerHTML++;
					count=1;
				}
				else{
					alert('每个人只能点赞或者踩一次');
					alert(data);
				}
			},

			error: function(data, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
		return ;
	}
	if(count== 1)
	{	

		$.ajax({
			url: "http://"+address+"/houtai/dianzan.php",
			type: 'post',
			data: "id="+zuoyeid+"&result=nozan",		
			async: true,
			success: function(data) {
				if(data==1){
					alert('取消点赞');
					zan.innerHTML--;
					count=-1;
				}
				else{					
					alert('每个人只能点赞或者踩一次');
				}
			},

			error: function(data, textStatus, errorThrown) {
				alert("取消点赞失败");
			}
		});
		return ;
	}
	
}
var countcai=-1
function diancai(id)
{	
	cai = document.getElementById('cai'+id+'');
	zuoyeid = cai.getAttribute('value');
	if(countcai == -1)
	{		
		$.ajax({
			url: "http://"+address+"/houtai/dianzan.php",
			type: 'post',
			data: "id="+zuoyeid+"&result=cai",
			async: true,
			success: function(data) {
				if(data==1){
					alert('点踩成功');
					cai.innerHTML++;
					countcai=1;
				}
				else{					
					alert('每个人只能点赞或者踩一次');
				}
			},

			error: function(data, textStatus, errorThrown) {
				alert("点踩失败");
			}
		});
		return ;
	}
	if(countcai== 1)
	{	
		$.ajax({
			url: "http://"+address+"/houtai/dianzan.php",
			type: 'post',
			data: "id="+zuoyeid+"&result=nocai",
			async: true,
			success: function(data) {
				if(data==1){
					alert('取消点踩');
					cai.innerHTML--;
					countcai=-1;
				}
			},

			error: function(data, textStatus, errorThrown) {
				alert("取消点踩失败");
			}
		});
		return ;
	}
}


function huifu(zuoyeid,renwuid,result)
{
	if(result == 1)
	{
	document.pinglunform.action='houtai/pinglun.php?zuoyeid='+zuoyeid+'&renwuid='+renwuid+'';
	$( "#dialog" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 510,   //弹出框宽度
	height : 300,   //弹出框高度
	title : "用户回复",  //弹出框标题
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
	}
	else 
	{
		alert('请先登陆账号');
	}
}

function pingjia(zuoyeid,renwuid,result)
{
	if(result == 1)
	{
	document.pingjiaform.action='houtai/pingjia.php?zuoyeid='+zuoyeid+'&renwuid='+renwuid+'';
	$( "#pingjia" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
	title : "评价",  //弹出框标题
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
	}
	else 
	{
		alert('请先登陆账号');
	}
}
    
function xingming()
{
	document.xingmingform.action='houtai/xiugaixinxi/xiugaixingming.php';
	$( "#xiugaixingming" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}

function fangxiang()
{

	document.fangxiangform.action='houtai/xiugaixinxi/xiugaifangxiang.php';
	$( "#xiugaifangxiang" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}

function kecheng()
{

	document.kechengform.action='houtai/xiugaixinxi/xiugaikecheng.php';
	$( "#xiugaikecheng" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}

function gonghao()
{

	document.gonghaoform.action='houtai/xiugaixinxi/xiugaigonghao.php';
	$( "#xiugaigonghao" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}
function xuexiao()
{

	document.xuexiaoform.action='houtai/xiugaixinxi/xiugaixuexiao.php';
	$( "#xiugaixuexiao" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 310,   //弹出框宽度
	height : 250,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}
function mima()
{

	document.mimaform.action='houtai/xiugaixinxi/xiugaimima.php';
	$( "#xiugaimima" ).dialog({
	modal : true,    // 设置为模态对话框
	width : 410,   //弹出框宽度
	height : 300,   //弹出框高度
			buttons:{
	
				'取消':function(){
				$(this).dialog("close");
				}
			}
	});
}

function xmTanUploadImg(obj) {
  var file = obj.files[0];               
  var reader = new FileReader();
  reader.onloadstart = function (e) {
    
  }
    reader.onprogress = function (e) {
         
  }
  reader.onabort = function (e) {
    
  }
  reader.onerror = function (e) {
      
  }
  reader.onload = function (e) {
      
  var img = document.getElementById("avarimgs");
      img.src = this.result;
   //或者 img.src = this.result;  //e.target == this
  }
      reader.readAsDataURL(file)
  }