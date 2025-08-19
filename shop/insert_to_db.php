<body>
<?php 
session_start();
include("../config/mysql_connect.inc.php");

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
    h2 {
        color: #E53935;
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
<script>
let countdown = $sec;
function updateCountdown(){
    if(countdown <= 0){
        window.location.href = "$url";
    } else {
        document.getElementById("countdown").innerText = "系統將在 " + countdown + " 秒後自動返回首頁";
        countdown--;
        setTimeout(updateCountdown, 1000);
    }
}
window.onload = updateCountdown;
</script>
</head>
<body>
    <div class="card">
        <h2>$msg</h2>
        <p id="countdown">系統將在 $sec 秒後自動返回首頁</p>
        <a href="$url">立即返回</a>
    </div>
</body>
</html>
HTML;
    exit;
}

// 檢查購物車是否為空
if (empty($_SESSION['gwc'])){
    showMessage("購物車為空!");
}

$total = $_SESSION['total'] ?? 0;
$arr = $_SESSION['gwc'];
$time = time();
$date = date("Y-m-d");

// 插入訂單
$sql = "INSERT INTO orders VALUES ($time, '{$_SESSION['username']}', $total, '$date')";
if(mysqli_query($con, $sql)){
    $msg = "提交成功!";
} else {
    $msg = "提交失敗!";
}

// 插入訂單明細並更新庫存
foreach ($arr as $item_id => $qty){
    $sqll = "INSERT INTO detail VALUES ($time, $item_id, $qty)";
    mysqli_query($con, $sqll);

    $sql_update = "UPDATE shop SET storage = storage - $qty WHERE `item.no` = $item_id";
    mysqli_query($con, $sql_update);
}

// 清空購物車
unset($_SESSION['gwc']); 
unset($_SESSION['total']); 

// 顯示成功或失敗訊息
showMessage($msg);
?>
</body>
