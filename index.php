<?php
include "settings.php";
$conn = new mysqli($servername, $username, $password, $dbname);
global $conn;
function getone($probid,$userid)
{
  global $conn;
  //echo $probid.','.$userid."<br>";
  $sql = "SELECT * FROM status WHERE userid=".$userid." AND problemid=".$probid;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
      //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      $r = $row;

    }
  } else {
    //echo "0 结果";
  }
  if($r['status'] == "RIGHT") return " class=success";
  else if($r['status'] == 'WRONG') return ' class=error';
  return $r['status'];
}
$status = "";

// 创建连接

// Check connection
if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}
if ((stripos($_SERVER['HTTP_USER_AGENT'], "micro")) != FALSE) {
  echo '<!DOCTYPE html>
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
                                                          <body>警告：检测到在微信中打开，请点击右上角三个点，选择“在浏览器中打开”！\</body>
                                                          </html>';
  exit;
} else { //不在微信中打开
  if (empty($_POST['username'])) {
    if (empty($_COOKIE["userid"])) {
      header('Location: login.html');
      exit;
    }
  }
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);
  $i = FALSE;
  if ($result->num_rows > 0) {
    // 输出数据
    while ($row = $result->fetch_assoc()) {
      //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      if ($row['username'] == $_POST['username']) {
        if ($row['password'] == $_POST['password']) {
          $i = TRUE;
          $premission = $row['premission'];
          $id = $row['userid'];
          $jsteacher = $row['jsteacher'];
        }
      }
    }
    if ($i == FALSE) {
      if (!empty($_COOKIE["userid"])) {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $i = FALSE;
        if ($result->num_rows > 0) {
          // 输出数据
          while ($row = $result->fetch_assoc()) {
            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            if ($row['userid'] == $_COOKIE["userid"]) {
              $i = TRUE;
              $premission = $row['premission'];
              $id = $row['userid'];
              $jsteacher = $row['jsteacher'];
            }
          }
        }
      }
    }
    setcookie("userid", strval($id), time() + 3000);
    echo '<!DOCTYPE html>
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
                                                              <body>
                                                                  <div class="container">
                                                                      <div class="row clearfix">
                                                                          <div class="col-md-12 column">
                                                                              <nav class="navbar navbar-default" role="navigation">
                                                                                  <div class="navbar-header">
                                                                                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                                                          <span class="sr-only">
                                                                                              Toggle navigation
                                                                                          </span>
                                                                                          <span class="icon-bar">
                                                                                          </span>
                                                                                          <span class="icon-bar">
                                                                                          </span>
                                                                                          <span class="icon-bar">
                                                                                          </span>
                                                                                      </button>
                                                                                      <a class="navbar-brand" href="index.php">
                                                                                          FredTools 作业系统
                                                                                      </a>
                                                                                  </div>
                                                                                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                                                                      <form class="navbar-form navbar-left" role="search" action=probleminfo.php method=get>
                                                                                          <div class="form-group">
                                                                                              <input type="text" class="form-control" name=id>
                                                                                          </div>
                                                                                          <button type="submit" class="btn btn-default">
                                                                                              查看题目（题目编号搜索）
                                                                                          </button>
                                                                                      </form>
                                                                                      <ul class="nav navbar-nav navbar-right">
                                                                                          <li>
                                                                                              <a href="login.html">
                                                                                                  重新登录
                                                                                              </a>
                                                                                          </li>
                                                                                      </ul>
                                                                                  </div>
                                                                              </nav>';
    if ($i == TRUE) {
      echo "登陆成功！<br>";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
      }
      echo '您的权限为：' . $premission . '<br>';
      if ($premission == 'superadmin') {
        echo '<a href="signup.html"><button class="btn btn-info">注册用户</button></a><br>';
        echo '<a href="createproblem.html"><button class="btn btn-info">创建题目</button></a><br>';
        echo '<a href="delall.php"><button class="btn btn-info">删除所有题目<strong>（慎选！！！！！）</strong></button></a><br>';
        echo '<a href=delauser.php><button class="btn btn-info">删除一个用户</button></a><br>';
        echo '<a href=seeallusers.php><button class="btn btn-info">查看所有用户（纯英文）</button></a><br>';
      } else if ($premission == 'teacher') {
        echo '<a href="createproblem.html"><button class="btn btn-info">创建题目</button></a><br>';
      }

      $sql = "SELECT * FROM problem";
      $result = $conn->query($sql);
      echo '<table class="table"><thead><tr><th>编号</th><th>题目名称</th><th></th><th></th></tr></thead><tbody>';
      if ($result->num_rows > 0) {
        // 输出数据
        while ($row = $result->fetch_assoc()) {
          if(((stripos($jsteacher, $row['fromusername'])) != FALSE))
            //echo "题目" . $row["problemid"] . " - " . $row["problemtitle"] . '<a href="probleminfo.php?id=' . $row['problemid'] . '"><button class="b">点我做题</button>' . "</a><br>";
            echo '<tr'.getone(intval($row['problemid']),intval($_COOKIE['userid'])).'><!--加上class=success就是已做，class=error就是答案错误--><td>'.$row['problemid'].'</td><td>'.$row["problemtitle"].'   </td><td></td><td><button type="button" class="btn btn-info" onclick="document.href=\"http://homework.ascendto.top/probleminfo.php?id='.$row['problemid'].'\"">开始做题</button> </td></tr>';
          else
            if($jsteacher == '')
            {
              //echo "题目" . $row["problemid"] . " - " . $row["problemtitle"] . '<a href="probleminfo.php?id=' . $row['problemid'] . '"><button class="b">点我做题</button>' . "</a><br>";
              echo '<tr'.getone(intval($row['problemid']),intval($_COOKIE['userid'])).'>
                                                                                          <!--加上class=success就是已做，class=error就是答案错误-->
                                                                                          <td>
                                                                                              '.$row['problemid'].'
                                                                                          </td>
                                                                                          <td>
                                                                                              '.$row["problemtitle"].'
                                                                                          </td>
                                                                                          <td>
                                                                                          </td>
                                                                                          <td>
                                                                                              <a href="http://homework.ascendto.top/probleminfo.php?id='.$row['problemid'].'"><button type="button" class="btn btn-info">开始做题</button></a>
                                                                                          </td>
                                                                                      </tr>';
            }
        }
      } else {
        echo "无题目<br>";
      }

    } else {
      echo '用户名或密码错误，登陆失败！<a href="login.html"><button class="btn btn-info">重新登录</button></a>';
    }
  } else {
    echo '用户名或密码错误，登陆失败！<a href="login.html"><button class="btn btn-info">重新登录</button></a>';
  }
}
$conn->close();
?>
</tbody>
</table>
</div>
</div>
</div>
</body>

</html>
