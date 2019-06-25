<?php
 include "settings.php";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "INSERT INTO users (username,password,userid,jifen,premission,jsteacher)
VALUES (\"".$_POST['username'].'","'.$_POST['password'].'",'.$_POST['userid'].','.$_POST['jifen'].',"'.$_POST['premission']."\",\"".$_POST['jsteacher']."\")";
 
if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>