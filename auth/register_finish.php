<body bgcolor=#FF7878>

<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../config/mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        //新增資料進資料庫語法
        $sql = "insert into login (username, password, telephone, address) values ('$id', '$pw', '$telephone', '$address')";
        if(mysqli_query($con , $sql))
        {
                echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>新增成功!</h2></center>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        }
        else
        {
                echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>新增失敗，帳號或密碼為空!</h2></center>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        }
}
else
{
        echo '<center><h2><br><br><br><br><br><br><br><br><br><br><br><br><br>輸入資料不符合格式或第二次密碼錯誤!!</h2></center>';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>