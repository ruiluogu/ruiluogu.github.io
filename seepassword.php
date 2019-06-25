<?php
$userid = $_GET['userid'];
include "settings.php";
if($userid == "1")
{
  echo "别想看我的密码！";
  echo '<a href=index.php>Back</a>';
  exit;
}


// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      if($row['userid'] == $userid)
      {
        echo "Passwd:".$row['password']."<br>";
      }
    }
} else {
    echo "0 结果";
}
echo '<a href=index.php>Back</a>';
$conn->close();
?>