<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);
if($_REQUEST['title']!=''){
$out1 = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><title>".$_REQUEST['title']."</title>
<style>
body{
	width:960px;
	margin:0 auto;
}
#title{
	text-align:center;
}
</style>
</head><body><div id='title'><h2>".$_REQUEST['title']."</h2></div>".$_REQUEST['content']."</body></html>";
$file=str_replace(" ", '', $_REQUEST['title'].'.html');
$name=iconv("UTF-8","gb2312", $file);
$fp = fopen("./html/".$name,"w");
if(!$fp){
echo "System Error";
exit();
}else{
fwrite($fp,$out1);
fclose($fp);
$fp = fopen("./html/html.txt","a");
fwrite($fp,$file."{**}");
fclose($fp);
echo "<script>window.location ='index.php'; </script>";
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加文章</title>
<link rel="stylesheet" href="./bianjiqi/themes/default/default.css" />
<link rel="stylesheet" href="./bianjiqi/plugins/code/prettify.css" />
<script charset="utf-8" src="./bianjiqi/kindeditor.js"></script>
<script charset="utf-8" src="./bianjiqi/lang/zh_CN.js"></script>
<script charset="utf-8" src="./bianjiqi/plugins/code/prettify.js"></script>
<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[id="goods_con"]', {
				cssPath : './bianjiqi/plugins/code/prettify.css',
				uploadJson : './bianjiqi/php/upload_json.php',
				fileManagerJson : './bianjiqi/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});

				}
			});
			prettyPrint();
		});

</script>
</head>
<body style="margin:50px auto;width:960px;">
<form  name="example" method="post" action="add.php" >
标题：<br/><input style="width:960px" type="text" name='title'><br/><br/>
内容：<textarea name="content" style="width:960px;height:450px;visibility:hidden;" id="goods_con" ></textarea><br/><br/>
<input style="margin-left:900px;padding:2px 10px" type="submit" value="提交"  class="submit"  onclick="return chenk()"/>
</form>
</body>
</html>