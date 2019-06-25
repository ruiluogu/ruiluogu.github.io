
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
        <style>
.b {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border-radius: 4px;
}
</style>
	</head>
	<body><center>
<?php
include "settings.php";
$userid = $_COOKIE['userid'];
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "SELECT * FROM status";
$result = $conn->query($sql);
$count = $result->num_rows;
$conn->close();

//userid problemid submitid status useranswer

 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$submitid = $count;
$sql = "INSERT INTO status (userid,problemid,submitid,status,useranswer)
VALUES (".$userid.",".$_GET['id'].",".$submitid.",'WAITING','".$_POST['useranswer']."')";
 
if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$sql = "SELECT * 
FROM  `problem` ";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $answer = $row['problemanswer'];
    }
}
$conn->close();
if($_POST['useranswer'] == $answer)
{
$con=mysqli_connect("localhost","homework","fred070913","homework");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($con,"UPDATE status SET status='RIGHT'
WHERE submitid=".$submitid);

mysqli_close($con);
echo '答案正确！';
echo '<br><a href=index.php><button type="button" class="btn btn-default">点我返回</button></a>';
}
else 
{
$con=mysqli_connect("localhost","homework","fred070913","homework");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($con,"UPDATE status SET status='WRONG'
WHERE submitid=".$submitid);

mysqli_close($con);
echo '答案错误！';
echo '您的答案：'.$_POST['useranswer']."<br>正确答案：".$answer;
  echo '<br><a href=index.php><button type="button" class="btn btn-default">点我返回</button></a>';
}
?></center>
      </body>

</html>