<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>
			FredTools 作业系统
		</title>
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js">
		</script>
		<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
		</script></head>
	<body>
<?php
      include "settings.php";
//DELETE FROM `users` WHERE userid=822
if(empty($_POST['userid']))
{
echo '<form action=delauser.php method=post>请输入学号：<input type=text name=userid><button type="submit" class="btn btn-info">提交</button></form>';
}
else
{
$con=mysqli_connect($hostname,$username,$password,$database);
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($con,"DELETE FROM `users` WHERE userid=".$_POST['userid']);

mysqli_close($con);
echo 'OKay!<br><a href="index.php"><button type="submit" class="btn btn-info">Back</button></a>';
}
?>
      </body>
</html>