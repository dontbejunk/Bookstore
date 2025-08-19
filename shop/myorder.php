<!DOCTYPE html>
<html lang="zh-Hant">
<head>
<meta charset="UTF-8">
<title>我的訂單</title>
<style>
    body {
        margin: 0;
        font-family: "Microsoft JhengHei", Arial, sans-serif;
        background: linear-gradient(to right, #FFD78C, #FFBFBF);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 0;
    }
    a.back-link {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background: #FF9800;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background 0.3s;
    }
    a.back-link:hover { background: #F57C00; }

    table {
        width: 80%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    th {
        background-color: #FFBFBF;
        color: #fff;
        font-size: 18px;
    }
    tr:hover { background-color: #FFE5D1; }
    td a {
        color: #FF5722;
        text-decoration: none;
        font-weight: bold;
    }
    td a:hover { text-decoration: underline; }
</style>
</head>
<body>

<a href="../index.php" class="back-link">上一頁</a>

<table>
    <tr>
        <th>訂單編號</th>
        <th>總價格</th>
        <th>日期</th>
    </tr>

<?php 
session_start();
include("../config/mysql_connect.inc.php");

$username = $_SESSION['username'] ?? '';
if (!$username) {
    echo "<tr><td colspan='3'>請先登入</td></tr>";
    exit;
}

// 使用 prepared statement 避免 SQL 注入
$stmt = $con->prepare("SELECT `order.no`, `total`, `date` FROM `orders` WHERE `user` = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while($v = $result->fetch_assoc()) {
        $order_no = $v['order.no'];
        echo "<tr>
                <td><a href='detail.php?ids={$order_no}'>{$order_no}</a></td>
                <td>{$v['total']}</td>
                <td>{$v['date']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>目前沒有訂單</td></tr>";
}
?>
</table>

</body>
</html>
