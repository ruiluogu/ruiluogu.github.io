<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
FredTools-作业系统-查看问题
</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js">
		</script>
		<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
		</script>
</head>
<body>
<center>
<?php
include "settings.php";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "SELECT * FROM problem";
$result = $conn->query($sql);
//VALUES (".$_GET['userid'].",".$_GET['problemid'].",".$submitid.",'WAITING',"$_POST['useranswer']")";
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      if($row['problemid'] == $_GET['id'])
      {
        echo "<a href='index.php'>返回</a><br>";
        echo "<h2>题目".strval($row['problemid'])." - ".$row['problemtitle'].'<br>';
        echo "题目内容：".strval($row['problemdetail'])."<br>";
        if($row['problemtype'] == 1)
        {
          echo '<form action="cheak.php?id='.$_GET['id'].'&type=1" method=post>请输入您的答案（多个答案以空格隔开）：<input type=text name=useranswer class="form-control" id="name"><br><button type=submit class="btn btn-default">提交</button></form>';
        }
        else if($row['problemtype'] == 2)
        {
          echo '<form action="cheak.php?id='.$_GET['id'].'&type=2" method=post><div class=cheakbox>
    <input type="radio" name="useranswer" value="y" />√
    <input type="radio" name="useranswer" value="n" />×
    </div>
    <button  class="btn btn-default" type=submit>提交</button>
</form>';
        }
        //echo '<form action="cheak.php?id='.$_GET['id'].'" method=post>请输入您的答案（多个答案以空格隔开）：<input type=text name=useranswer><br><input type=submit name=提交 value=提交></form>';
      }
      
    }
} else {
    echo '0 结果<br><a href="index.php"><button class="btn btn-info btn-lg">Back</button></a>';
}
$conn->close();
?>
</center>
</body>
</html>