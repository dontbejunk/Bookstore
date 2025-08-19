<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <title>Login</title> 
    <style>
        body { font-family: Arial, sans-serif; background: #FFF3E0; margin: 0; padding: 0; }
        #frm { 
            width: 300px; 
            margin: 100px auto; 
            background: #fff; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            text-align: center;
        }
        input[type=text], input[type=password] {
            width: 80%; padding: 8px; margin: 8px 0;
            border: 1px solid #ccc; border-radius: 5px;
        }
        #btn {
            padding: 10px 20px; 
            background: #FF9800; 
            border: none; 
            border-radius: 5px; 
            color: #fff; 
            cursor: pointer;
        }
        #btn:hover { background: #F57C00; }
        a { display: block; margin: 5px 0; color: #FF9800; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div id="frm">
    <h2>會員登入</h2>
    <form name="form" method="post" action="../config/connect.php">
        <input type="text" name="id" placeholder="帳號" required /><br>
        <input type="password" name="pw" placeholder="密碼" required /><br>
        <a href="./register.php">申請帳號</a>
        <a href="./revise.php">忘記密碼</a>
        <br><br>
        <input type="submit" name="button" value="登入" id="btn" />
    </form>
</div>

</body>
</html>
