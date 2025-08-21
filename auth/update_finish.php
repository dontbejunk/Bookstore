<?php
session_start();
include("../config/mysql_connect.inc.php");

$pw = $_POST['pw'] ?? '';
$pw2 = $_POST['pw2'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$address = $_POST['address'] ?? '';
$id = $_SESSION['username'] ?? '';

$success = false;
$msg = "修改錯誤!";
$redirect = "./login.php";

if($id && $pw && $pw2 && $pw === $pw2) {
    $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

    $stmt = $con->prepare("UPDATE login SET password = ?, telephone = ?, address = ? WHERE username = ?");
    $stmt->bind_param("ssss", $hashed_pw, $telephone, $address, $id);

    if($stmt->execute()) {
        $success = true;
        $msg = "修改成功!";
        $redirect = "../index.php";
    } else {
        $msg = "修改失敗，請稍後再試!";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>會員修改結果</title>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background: linear-gradient(135deg, #FFB6B9, #FFD6A5);
    font-family: 'Arial', sans-serif;
}
.card {
    background: #fff;
    padding: 50px 80px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    text-align: center;
    animation: pop 0.5s ease-out;
}
h2 {
    color: <?= $success ? '#4CAF50' : '#E53935' ?>;
    margin-bottom: 20px;
}
a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #FF9800;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}
a:hover { background: #F57C00; }
@keyframes pop {
    0% { transform: scale(0.7); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>
</head>
<body>
<div class="card">
    <h2><?= $msg ?></h2>
    <p id="countdown">系統將在 2 秒後自動跳轉</p>
    <a href="<?= $redirect ?>">立即返回</a>
</div>
<script>
let sec = 2;
const countdown = document.getElementById('countdown');
const timer = setInterval(() => {
    sec--;
    countdown.textContent = `系統將在 ${sec} 秒後自動跳轉`;
    if(sec <= 0) {
        clearInterval(timer);
        window.location.href = "<?= $redirect ?>";
    }
}, 1000);
</script>
</body>
</html>
