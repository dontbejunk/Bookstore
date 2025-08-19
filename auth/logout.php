<?php 
session_start();
unset($_SESSION['username']); // 清空 session
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <title>登出中...</title>
    <style>
        body { 
            background: url('https://img.1ppt.com/uploads/allimg/1604/4_160415110243_1.jpg') no-repeat center center fixed; 
            background-size: cover;
            font-family: Arial, sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
            text-shadow: 1px 1px 4px #000;
        }
        .msg-box {
            background: rgba(0,0,0,0.4);
            padding: 30px 50px;
            border-radius: 10px;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "../index.php";
        }, 1000); // 1 秒後跳轉
    </script>
</head>
<body>
    <div class="msg-box">
        <h2>登出中......</h2>
        <p>1 秒後將回到首頁</p>
    </div>
</body>
</html>
