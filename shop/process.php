<?php
session_start();
include("../config/mysql_connect.inc.php");

if (!isset($_SESSION['username'])) {
    showMessage("請先登入會員才能加入購物車！", "../auth/login.php");
}

$item = isset($_GET['ids']) ? intval($_GET['ids']) : 0;
if($item <= 0){
    die("參數錯誤");
}

// Prepared Statement 查庫存
$stmt = $con->prepare("SELECT storage FROM shop WHERE `item.no` = ?");
$stmt->bind_param("i", $item);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();

if(!$row){
    die("商品不存在");
}

// 顯示訊息函式
function showMessage($msg, $url='../index.php', $sec=2){
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>提示訊息</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #FFD78C;
        font-family: Arial, sans-serif;
        margin: 0;
    }
    .card {
        background: #fff;
        padding: 50px 80px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        text-align: center;
        animation: pop 0.5s ease-out;
    }
    h2 { color: #E53935; margin-bottom: 20px; }
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
    @keyframes pop { 0% { transform: scale(0.7); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
</style>
</head>
<body>
    <div class="card">
        <h2>$msg</h2>
        <p id="countdown">系統將在 $sec 秒後自動返回首頁</p>
        <a href="$url">立即返回</a>
    </div>

    <script>
        let seconds = $sec;
        const countdown = document.getElementById('countdown');
        const interval = setInterval(() => {
            seconds--;
            if(seconds <= 0){
                clearInterval(interval);
                window.location.href = '$url';
            } else {
                countdown.textContent = '系統將在 ' + seconds + ' 秒後自動返回首頁';
            }
        }, 1000);
    </script>
</body>
</html>
HTML;
    exit;
}


// 檢查庫存
if(($row[0]-1) < 0){
    showMessage("庫存不足!");
}

// 初始化購物車
if(!isset($_SESSION['gwc'])){
    $_SESSION['gwc'] = [];
}

// 加入購物車
if(isset($_SESSION['gwc'][$item])){
    if($_SESSION['gwc'][$item]+1 > $row[0]){
        showMessage("庫存不足!");
    }
    $_SESSION['gwc'][$item] += 1;
} else {
    $_SESSION['gwc'][$item] = 1;
}

showMessage("加入中，請稍後!");

?>
