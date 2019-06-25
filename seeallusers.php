<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
FredTools-作业系统
</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
<?php
include "settings.php";
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
        echo "userid: " . $row["userid"]. " - username: " . $row["username"]. " - Premission: " . $row["premission"]. " - Password:<a href='seepassword.php?userid=".$row['userid']."'>See</a><br>";
    }
} else {
    echo "0 结果";
}
echo "<a href=index.php><button class=\"b\">Back</button></a>";
$conn->close();
?>
</html>