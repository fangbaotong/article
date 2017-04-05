<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);
if(filesize("./html/html.txt")!=0){
$fp = fopen("./html/html.txt","r");
$content=fread($fp,filesize("./html/html.txt"));
fclose($fp);
$content=rtrim($content,"{**}");
$content=trim($content, "\xEF\xBB\xBF");//去除bom头
$content=explode("{**}",$content);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<style>
.ee{
border: 1px solid #696;
padding:10px;
width: 208px;
height:100px;
float:left;
margin-right:10px;
margin-top:10px;
/*圆角*/
-webkit-border-radius: 8px; /*苹果 谷歌*/
-moz-border-radius: 8px; /*Mozilla Firefox */
border-radius: 8px; /*Mozilla Firefox Safari3*/
/*外阴影*/
-webkit-box-shadow: #666 0px 0px 10px;
-moz-box-shadow: #666 0px 0px 10px;
box-shadow: #666 0px 0px 10px;
background: #EEFF99;
}
a {
   text-decoration:none;
   }
.ee{position:relative;}   
.bt{
	position:absolute;
	bottom:10px;
	right:10px; 
}
.bt1{
	position:absolute !important;
	bottom:10px !important;
	right:60px !important; 
}
</style>
<script src="jquery-1.7.1.min.js" type="text/javascript"></script>
<script>
function del(ui){
	if(confirm('确定将此记录删除?')){
	$.post("delete.php",{ui:ui},function(data){
			alert(data);
			location=location;
		})	
	}
}
function upd(ui){
	location="update.php?ui="+ui;
}
</script>
</head>
<body style="margin:50px auto;width:960px;">
<a href='add.php' style="border:1px solid grey; padding:5px 458px">添加</a><br/><br/>
<?php
if(!empty($content)){ 
	foreach($content as $con){
	echo "<div class='ee'><a target='_Blank' href=./html/$con>".rtrim($con,'.html')."</a><br/><br/><button onclick=del('".$con."') class='bt'>删除</button><button onclick=upd('".$con."') class='bt bt1'>修改</button></div>";	
	}
}
?>
<div id="sss"></div>
</body>
</html>