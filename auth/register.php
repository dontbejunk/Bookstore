<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>會員註冊</title>
<link rel="stylesheet" href="../style.css">
<style>
body {
    background: #FF7878;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-card {
    background: #fff;
    padding: 40px 50px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    width: 350px;
    text-align: center;
}

.form-card h2 {
    margin-bottom: 30px;
    color: #E53935;
}

.form-card input[type="text"],
.form-card input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.form-card input[type="submit"] {
    width: 100%;
    padding: 10px;
    background: #FF9800;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

.form-card input[type="submit"]:hover {
    background: #F57C00;
}
</style>
</head>
<body>
<div class="form-card">
    <h2>會員註冊</h2>
    <form name="form" method="post" action="register_finish.php">
        <input type="text" name="id" placeholder="帳號" required>
        <input type="password" name="pw" placeholder="密碼" required>
        <input type="password" name="pw2" placeholder="再次輸入密碼" required>
        <input type="text" name="telephone" placeholder="電話">
        <input type="text" name="address" placeholder="地址">
        <input type="submit" name="button" value="確定">
    </form>
</div>
</body>
</html>
