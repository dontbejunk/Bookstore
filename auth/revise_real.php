<body bgcolor=#FF7878>
<?php session_start();
include("../config/mysql_connect.inc.php");
$id = $_SESSION['user'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];

if ($pw == $pw2 && $pw != NULL){
    $sql = "UPDATE login SET password = '$pw' WHERE `username`= '$id'";
    $result = mysqli_query($con, $sql);
    echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>成功!</h2></center>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
else{
    echo '<center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><h2>第二次密碼錯誤或密碼為空白!</center>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=revise.php>';
}

?>
</body>