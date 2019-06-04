<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
FredTools-作业系统-登录
</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
FredTools-作业系统-注册(管理员)
</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<form action="createdproblem.php" method=post>
  题目标题：<input type='text' name='title'><br>
  题目内容：<input type='text' name='detail'><br>
  题目答案：<input type='text' name='answer'><br>
  题目id：<input type='text' name='id'><br>
  <input type=submit name=创建 value=创建>
</form>
</body>
</html> -->
<?php
  $title = $_POST['title'];
  $detail = $_POST['detail'];
  $answer = $_POST['answer'];
  $problemid = $_POST['id'];
  $type=$_POST['type'];
include "settings.php";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

  
  
  
  
$sql = "SELECT * FROM users WHERE userid=".strval($_COOKIE['userid']);
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      $fromusername = $row['username'];
    }
} else {
    echo "0 结果";
}
  //-------------------------------------------------------------------------------------------------------------------
$sql = "INSERT INTO problem (problemid,problemtitle,problemdetail,problemanswer,problemtype,fromusername)
VALUES (".$problemid.",'".$title."','".$detail."','".$answer."',".$type.",'".$fromusername."')";
 
if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功 <a href=index.php> 点我返回</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>
</body>
</html>