<?php
session_start();
unset($_SESSION['gwc']);
include("mysql_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];

// 使用 Prepared Statement 避免 SQL Injection
$stmt = $con->prepare("SELECT username, password FROM login WHERE username = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($id != null && $pw != null && $row) {
    
    if (password_verify($pw, $row['password'])) {
        $_SESSION['username'] = $id;
        $message = "登入成功！";
        $redirect = "../index.php";

        
    } else {
        $message = "登入失敗！帳號或密碼錯誤";
        $redirect = "../index.php";
    }
} else {
    $message = "登入失敗！帳號或密碼錯誤";
    $redirect = "../index.php";
}
$stmt->close();
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
