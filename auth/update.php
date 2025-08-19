<?php
session_start();
include("../config/mysql_connect.inc.php");

if(!isset($_SESSION['username'])){
    echo '請先登入';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
    exit;
}

$id = $_SESSION['username'];

// Prepared statement
$stmt = $con->prepare("SELECT * FROM login WHERE username = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>修改會員資料</title>
<link rel="stylesheet" href="../style.css">
<style>
body {
    background-image: url('https://img.1ppt.com/uploads/allimg/1604/4_160415110243_1.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
}
.form-card {
    background: rgba(255,255,255,0.9);
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}
.form-card h2 { text-align: center; margin-bottom: 20px; }
.form-card input[type="text"], .form-card input[type="password"] {
    width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc;
}
.form-card input[type="submit"] {
    width: 100%; padding: 10px; background: #FF9800; color: white; border: none; border-radius: 5px;
    cursor: pointer; font-size: 16px;
}
.form-card input[type="submit"]:hover { background: #F57C00; }
</style>
</head>
<body>
<div class="form-card">
    <h2>修改會員資料</h2>
    <form method="post" action="update_finish.php">
        <label>帳號（不可修改）</label>
        <input type="text" name="id" value="<?=htmlspecialchars($row['username'])?>" readonly>

        <label>密碼</label>
        <input type="password" name="pw" placeholder="請輸入新密碼">

        <label>再次輸入密碼</label>
        <input type="password" name="pw2" placeholder="請再次輸入密碼">

        <label>電話</label>
        <input type="text" name="telephone" value="<?=htmlspecialchars($row['telephone'])?>">

        <label>地址</label>
        <input type="text" name="address" value="<?=htmlspecialchars($row['address'])?>">

        <input type="submit" value="確定">
    </form>
</div>
</body>
</html>
