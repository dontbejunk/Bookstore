<?php
session_start();

$item_no = isset($_GET['ids']) ? intval($_GET['ids']) : 0;
if($item_no <= 0 || empty($_SESSION["gwc"]) || !isset($_SESSION["gwc"][$item_no])){
    header("Location: cart.php");
    exit;
}

// 減少數量或刪除
if($_SESSION['gwc'][$item_no] > 1){
    $_SESSION['gwc'][$item_no]--;
    $message = "已將商品數量減少 1";
} else {
    unset($_SESSION['gwc'][$item_no]);
    $message = "已刪除商品";
}

// 顯示美觀提示頁面
$redirect = "cart.php";
$sec = 2;
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>刪除商品</title>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('https://png.pngtree.com/thumb_back/fh260/background/20201208/pngtree-beautiful-purple-blooming-christmas-snowflake-image_503982.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
    margin: 0;
}
.card {
    background: rgba(255,255,255,0.9);
    padding: 40px 60px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
h4 { color: #E53935; }
a { text-decoration:none; color:#fff; background:#FF9800; padding:8px 15px; border-radius:5px;}
a:hover { background:#F57C00; }
</style>
</head>
<body>
<div class="card">
    <h4><?= $message ?></h4>
    <p id="countdown">系統將在 <?= $sec ?> 秒後返回購物車</p>
    <a href="<?= $redirect ?>">立即返回購物車</a>
</div>
<script>
let seconds = <?= $sec ?>;
const countdown = document.getElementById('countdown');
const interval = setInterval(() => {
    seconds--;
    if(seconds <= 0){
        clearInterval(interval);
        window.location.href = "<?= $redirect ?>";
    } else {
        countdown.textContent = '系統將在 ' + seconds + ' 秒後返回購物車';
    }
}, 1000);
</script>
</body>
</html>
