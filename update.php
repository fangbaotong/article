<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);
if($_REQUEST['ui']!=''){
	$ui=$_REQUEST['ui'];
	$ui=iconv("UTF-8","gb2312", $ui);
	$contents = file_get_contents("./html/".$ui);
	preg_match("/<body>([\s\S]+?)<\/body>/",$contents,$rel);
	$title=rtrim($_REQUEST['ui'],'.html');
}elseif($_REQUEST['ti']!=''){
	$title=str_replace(" ", '', $_REQUEST['title']);
	if($_REQUEST['ti']!=$title){
		$ti=$_REQUEST['ti'];

		$fp = fopen("./html/html.txt","r");
		$con=fread($fp,filesize("./html/html.txt"));
		fclose($fp);

		$con=str_replace($ti, $title, $con);
		$fp = fopen("./html/html.txt","w");
		fwrite($fp,$con);
		fclose($fp);
		
		$ti=iconv("UTF-8","gb2312", $ti);
		$file="./html/".$ti.'.html';
		$result = unlink($file);		
    }
    preg_match('/<div id="title">([\s\S]+?)<\/div>/',$_REQUEST['content'],$rel);
    $rep=str_replace($_REQUEST['ti'], $_REQUEST['title'], $rel[0]);
    $content=str_replace($rel[0], $rep, $_REQUEST['content']);
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
	</head><body>".$content."</body></html>";
	$file=str_replace(" ", '', $_REQUEST['title'].".html");
	$name=iconv("UTF-8","gb2312", $file);
	$fp = fopen("./html/".$name,"w");
	if(!$fp){
		echo "System Error";
		exit();
	}else{
	fwrite($fp,$out1);
	fclose($fp);
	}
	echo "<script>window.location ='index.php'; </script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
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
<form  name="example" method="post" action="update.php?ti=<?php echo $title;?>" >
标题：<br/><input style="width:960px" type="text" name="title" value="<?php echo $title;?>"><br/><br/>
内容：<textarea name="content" style="width:960px;height:650px;visibility:hidden;" id="goods_con" ><?php echo $rel[0];?> </textarea><br/><br/>
<input style="margin-left:900px;padding:2px 10px" type="submit" value="提交"  class="submit"  onclick="return chenk()"/>
</form>
</body>
</html>
