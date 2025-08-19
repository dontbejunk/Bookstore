<?php
session_start();
include("../config/mysql_connect.inc.php");

$id = $_SESSION['user'] ?? '';
$pw = $_POST['pw'] ?? '';
$pw2 = $_POST['pw2'] ?? '';

$success = false;
$msg = '';

if($pw && $pw === $pw2){
    $stmt = $con->prepare("UPDATE login SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $pw, $id); // "ss" 代表兩個 string
    if(mysqli_query($con, $sql)){
        $success = true;
        $msg = "修改成功!";
        $redirect = "../index.php";
    } else {
        $msg = "修改失敗，請稍後再試!";
        $redirect = "revise.php";
    }
} else {
    $msg = "第二次密碼錯誤或密碼為空白!";
    $redirect = "revise.php";
}

?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>修改密碼結果</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(135deg, #FFB6B9, #FF7878);
        font-family: Arial, sans-serif;
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
    @keyframes pop {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
</head>
<body>
<div class="card">
    <h2><?= $msg ?></h2>
    <p>系統將在 2 秒後自動返回</p>
</div>

<script>
    setTimeout(() => { window.location.href = "<?= $redirect ?>"; }, 2000);
</script>
</body>
</html>
