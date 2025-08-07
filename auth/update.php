<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Revise your profile</title>
  </head>
  <body background ="https://img.1ppt.com/uploads/allimg/1604/4_160415110243_1.jpg">
  <link rel = "stylesheet" type = "text/css" href = "../style.css">   
  <div id = "frm">
  </body>
</html>

<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../config/mysql_connect.inc.php");

if($_SESSION['username'] != null)
{
        //將$_SESSION['username']丟給$id
        //這樣在下SQL語法時才可以給搜尋的值
        $id = $_SESSION['username'];
        //若以下$id直接用$_SESSION['username']將無法使用
        $sql = "SELECT * FROM login where username='$id'";
        $result = mysqli_query($con ,$sql);
        $row = mysqli_fetch_row($result);
    
        
        echo "<form name=\"form\" method=\"post\" action=\"update_finish.php\">";
        echo "<center>　　　　　　　&nbsp&nbsp&nbsp帳號：<input type=\"text\" name=\"id\" value=\"$row[0]\" />(此項目無法修改) <br></center>";
        echo "<center>密碼：<input type=\"password\" name=\"pw\" value=\"$row[1]\" /> <br></center>";
        echo "　　&nbsp&nbsp&nbsp再一次輸入密碼：<input type=\"password\" name=\"pw2\" value=\"$row[1]\" /> <br>";
        echo "<center>電話：<input type=\"text\" name=\"telephone\" value=\"$row[2]\" /> <br></center>";
        echo "<center>地址：<input type=\"text\" name=\"address\" value=\"$row[3]\" /> <br></center>";
        echo "<center><input type=\"submit\" name=\"button\" value=\"確定\" /></center>";
        echo "<center></form></center>";
}
else
{
        echo 'error!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>