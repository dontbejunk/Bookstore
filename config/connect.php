<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Log in</title>
  </head>
  <body background ="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5IiEkUOyV5ry7QcOtJ9cMuXDZKqW8PG4fapmdMOaD6BKYTs-w-uqkQL8Nq76OqpEifEA&usqp=CAU">
    
  </body>
</html>


<?php session_start(); 
unset($_SESSION['gwc']); 
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
//搜尋資料庫資料
$sql = "SELECT * FROM login where username = '$id'";
$result = mysqli_query($con , $sql);
$row = mysqli_fetch_row($result);


if($id != null && $pw != null && $row[0] == $id && $row[1] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $id;
        echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>登入成功!</h2></center>"; 
        echo '<meta http-equiv=REFRESH CONTENT=1;url=../pages/member.php>';
}
else
{
        echo "<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>登入失敗!</h2></center>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
}
?>