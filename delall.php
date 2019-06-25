<?php
include "settings.php";
$sql = 'DELETE FROM \'problem\' WHERE 1';
$conn=mysqli_connect($hostname,$username,$password,$database);
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($conn,"DELETE FROM problem WHERE 1");
echo "OKay!<a href=\"index.php\">Back</a>";
mysqli_close($conn);
?>