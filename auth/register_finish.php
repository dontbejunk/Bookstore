<?php 
session_start();
include("../config/mysql_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];

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
    background: #FF7878;
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

// 判斷輸入
if($id && $pw && $pw2 && $pw === $pw2){
    $hashedPw = password_hash($pw, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO login (username, password, telephone, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $hashedPw, $telephone, $address);

    if($stmt->execute()){
        showMessage("新增成功!");
    } else {
        showMessage("新增失敗，帳號可能已存在或資料錯誤!");
    }

    $stmt->close();
} else {
    showMessage("輸入資料不符合格式或密碼不一致!");
}
?>
