<?php
session_start();
include("../config/mysql_connect.inc.php");

$id = $_POST['id'] ?? '';
$tel = $_POST['telephone'] ?? '';
$adr = $_POST['address'] ?? '';

$sql = "SELECT * FROM `login` WHERE `username` = '$id'";
$result = mysqli_query($con, $sql);

$valid = false;
if(mysqli_num_rows($result) > 0 && $tel != NULL && $adr != NULL ){
    while($v = mysqli_fetch_assoc($result)){
        if ($v['telephone'] == $tel && $v['address'] == $adr){
            $_SESSION['user'] = $id;
            $valid = true;
            break;
        }
    }
}

if(!$valid){
    $msg = "資料錯誤!";
    $redirect = "../index.php";
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>驗證失敗</title>
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
        color: #E53935;
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
    <h2>$msg</h2>
    <p>系統將在 2 秒後返回首頁</p>
</div>
<script>
    setTimeout(()=>{window.location.href='$redirect';}, 2000);
</script>
</body>
</html>
HTML;
    exit;
}

// 如果資料驗證成功，顯示新密碼表單
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>設定新密碼</title>
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
    input[type="password"] {
        padding: 8px;
        margin: 10px 0;
        width: 80%;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    #btn {
        padding: 10px 20px;
        background: #FF9800;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #btn:hover { background: #F57C00; }
    @keyframes pop {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
</head>
<body>
<div class="card">
    <h2>請設定新密碼</h2>
    <form name="form" method="post" action="revise_real.php">
        <input type="password" name="pw" placeholder="新密碼" required /><br>
        <input type="password" name="pw2" placeholder="再次輸入新密碼" required /><br>
        <input type="submit" name="button" value="確認" id="btn" />
    </form>
</div>
</body>
</html>
