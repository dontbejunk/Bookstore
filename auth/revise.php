<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>找回密碼</title>
<style>
    body {
        background-color: #FF7878;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    #frm {
        background-color: #fff;
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        text-align: center;
        width: 350px;
        animation: pop 0.5s ease-out;
    }
    h2 {
        color: #E53935;
        margin-bottom: 30px;
    }
    input[type="text"] {
        width: 80%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }
    input[type="submit"] {
        padding: 10px 25px;
        margin-top: 20px;
        background-color: #FF9800;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #F57C00;
    }
    @keyframes pop {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
</head>
<body>
<div id="frm">
    <h2>找回密碼</h2>
    <form name="form" method="post" action="rpsw.php">
        <input type="text" name="id" placeholder="帳號" required /><br>
        <input type="text" name="telephone" placeholder="電話" required /><br>
        <input type="text" name="address" placeholder="地址" required /><br>
        <input type="submit" name="button" value="確認" />
    </form>
</div>
</body>
</html>
