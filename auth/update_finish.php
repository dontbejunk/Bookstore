<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];


if($_SESSION['username'] != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        $id = $_SESSION['username'];
    
        //更新資料庫資料語法
    $sql = "update login set password= '{$_POST['pw']}', telephone= '{$_POST['telephone']}', address= '{$_POST['address']}' where username='$id'";
        if(mysqli_query($con , $sql))
        {
                echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>修改成功!</h2>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        }
        else
        {
                echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>修改失敗!</h2>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        }
}
else
{
        echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>修改錯誤!</h2>';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=./login.php>';
}
?>
