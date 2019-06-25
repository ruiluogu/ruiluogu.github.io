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
</script>
</head>
<body>
<center>
<?php
  $step = empty($_GET['step'])?0:intval($_GET['step']);
  if($step==0)
  {
    header("Location: install.php?step=1");
    exit;
  }
  else if($step==1)
  {
    echo '<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="jumbotron">
				<h1>
					欢迎使用FredTools Homework CMS 安装程序！
				</h1>
				<p>
					恭喜你，找到了一个原创良心作品。现在，我们先开始安装吧（其实步骤很少）。
				<p>
					 <a class="btn btn-primary btn-large" href="install.php?step=2">开始安装</a>
				</p>
			</div>
		</div>
	</div>
</div>';
  }
  else if($step==2)
  {
    echo '<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>
				首先，我们需要你的数据库信息。
			</h3>
			<form role="form" method="post" action="install.php?step=3">
				<div class="form-group">
					 <label for="exampleInput1">MySQL主机名</label><input type="text" class="form-control" id="exampleInput1" name="hostname" />
				</div>
                <div class="form-group">
					 <label for="exampleInput2">数据库名</label><input type="text" class="form-control" id="exampleInput2" name="database" />
				</div>
                <div class="form-group">
					 <label for="exampleInput3">用户名</label><input type="text" class="form-control" id="exampleInput3" name="username" />
				</div>
				<div class="form-group">
					 <label for="exampleInput4">密码</label><input type="password" class="form-control" id="exampleInput4" name="password" />
				</div>
                <div class="form-group">
					 <label for="exampleInput5">以及管理员账号</label><input type="text" class="form-control" id="exampleInput5" name="admin" />
				</div>
                <div class="form-group">
					 <label for="exampleInput6">管理员密码</label><input type="password" class="form-control" id="exampleInput6" name="adminpw" />
				</div>
				<button type="submit" class="btn btn-default">下一步</button>
			</form>
		</div>
	</div>
</div>';
  }
  else if($step=3)
  {

    $servername = $_POST['hostname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    // 创建连接
    $conn = mysqli_connect($servername, $username, $password);
    echo '<div class="container">' + 
      '<div class="row clearfix">' + 
      '<div class="col-md-12 column">' + 
      '<h3>';
    // 检测连接
    if (!$conn) {
      die("连接失败，请检查错误: " . mysqli_connect_error()."，<a href='install.php?step=2'><button class=\"btn btn-default\">返回</button></a></h3></div></div></div>");
    }
    echo "连接成功</h3>";
    
    $sql='CREATE TABLE problems (
    problemid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	problemtitle TEXT,
	problemdetail TEXT,
	problemanswer TEXT,
	problemtype INT(11),
    fromusername TEXT
)';
    if ($conn->query($sql) === TRUE) {
      echo "<h3>创建题目数据表成功</h3>";
    } else {
      echo "<h3>创建题目数据表错误: " . $conn->error."</h3>";
    }
    
    
    $sql='CREATE TABLE status (
     submitid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     userid INT(11),
     problemid INT(11),
     status TEXT,
     useranswer TEXT
)';
    if ($conn->query($sql) === TRUE) {
      echo "<h3>创建状态数据表成功</h3>";
    } else {
      echo "<h3>创建状态数据表错误: " . $conn->error."</h3>";
    }
    
    $sql='CREATE TABLE users (
     userid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     username TEXT,
     password TEXT,
     jifen TEXT,
     premission TEXT,
     jsteacher TEXT
)';
    if ($conn->query($sql) === TRUE) {
      echo "<h3>创建用户数据表成功</h3>";
    } else {
      echo "<h3>创建用户数据表错误: " . $conn->error."</h3>";
    }
    $f = fopen("./settings.php","w+");
    fwrite($f,'<?php
$servername = "'.$_POST['hostname'].'";
$username = "'.$_POST['username'].'";
$password = "'.$_POST['password'].'";
$dbname = "'.$_POST['database'].'";
$database="'.$_POST['database'].'";
?>');
    fclose($f);
    if($conn->query("INSERT INTO users (userid,username,password,jifen,premission,jsteacher)
VALUES (1,'".$_POST["admin"]."','".$_POST["adminpw"]."',10000,'superadmin','')")===TRUE)
    {
      echo '<h3>超级管理员创建成功</h3>';
    }
    else
    {
      die('<h3>超级管理员创建失败</h3>');
    }
    echo '<a href="install.php?step=4"><button type="button" class="btn btn-default">完成！</button></a>';
    echo '</div></div></div>';
    $conn->close();
  }
  else if($step==4)
  {
    echo '现在，您的homework CMS已经安装就绪了。记得删除install.php！有任何问题请提Issue：<a href="https://github.com/fred913/FThomeworkCMS">https://github.com/fred913/FThomeworkCMS</a>。使用愉快！<a href="login.html"><button type="button" class="btn btn-default">开始体验</button></a>';
  }
?>
</center>
</body>

</html>