<?php
session_start();
unset($_SESSION['gwc']);
include("mysql_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];

$sql = "SELECT * FROM login WHERE username = '$id'";
$result = mysqli_query($con , $sql);
$row = mysqli_fetch_row($result);

if($id != null && $pw != null && $row[0] == $id && $row[1] == $pw) {
    $_SESSION['username'] = $id;
    $message = "登入成功！";
    $redirect = "../index.php";
} else {
    $message = "登入失敗！帳號或密碼錯誤";
    $redirect = "../index.php";
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<title>登入狀態</title>
<style>
    body { font-family: Arial, sans-serif; background:#FFF3E0; text-align: center; }
    .msg-box { margin-top: 20%; padding: 30px; display: inline-block; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
</style>
<script>
    setTimeout(function(){ window.location.href = "<?= $redirect ?>"; }, 1000);
</script>
</head>
<body>
    <div class="msg-box">
        <h2><?= $message ?></h2>
        <p>1 秒後將自動跳轉...</p>
    </div>
</body>
</html>
